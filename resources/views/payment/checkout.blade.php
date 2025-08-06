<!DOCTYPE html>
<html>
<head>
    <title>Payment Checkout</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .payment-form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        #card-element {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #card-errors {
            color: #e51c23;
            margin-top: 10px;
        }
        .submit-button {
            background-color: #007cba;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .submit-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .payment-processing {
            text-align: center;
            display: none;
        }
    </style>
</head>
<body>
    <div class="payment-form">
        <h2>Complete Your Payment</h2>
        <p>Amount: ${{ number_format($amount, 2) }}</p>
        <p>Order ID: {{ $order_id }}</p>
        
        <form id="payment-form">
            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element">
                    <!-- Stripe will create form elements here -->
                </div>
                <div id="card-errors" role="alert"></div>
            </div>
            
            <button id="submit-button" class="submit-button">
                <span id="button-text">Pay ${{ number_format($amount, 2) }}</span>
                <span id="spinner" class="payment-processing">Processing...</span>
            </button>
        </form>
        
        <div id="payment-result" style="margin-top: 20px;"></div>
    </div>

    <script>
        // Initialize Stripe
        const stripe = Stripe('{{ env("STRIPE_PUBLISHABLE_KEY") }}');
        const elements = stripe.elements();

        // Create card element
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
            },
        });

        cardElement.mount('#card-element');

        // Handle real-time validation errors from the card Element
        cardElement.on('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');
        const buttonText = document.getElementById('button-text');
        const spinner = document.getElementById('spinner');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Disable the submit button
            submitButton.disabled = true;
            buttonText.style.display = 'none';
            spinner.style.display = 'inline-block';

            // Confirm the payment
            const {error} = await stripe.confirmCardPayment('{{ $client_secret }}', {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        // You can add billing details here if needed
                    }
                }
            });

            if (error) {
                // Show error to customer
                showError(error.message);
                
                // Re-enable the submit button
                submitButton.disabled = false;
                buttonText.style.display = 'inline-block';
                spinner.style.display = 'none';
            } else {
                // Payment succeeded
                showSuccess();
                
                // Redirect to success page or update UI
                setTimeout(() => {
                    window.location.href = '/payment/success/{{ $order_id }}';
                }, 2000);
            }
        });

        function showError(message) {
            const resultDiv = document.getElementById('payment-result');
            resultDiv.innerHTML = `
                <div style="color: #e51c23; padding: 10px; border: 1px solid #e51c23; border-radius: 4px; background-color: #fdf2f2;">
                    <strong>Payment failed:</strong> ${message}
                </div>
            `;
        }

        function showSuccess() {
            const resultDiv = document.getElementById('payment-result');
            resultDiv.innerHTML = `
                <div style="color: #27ae60; padding: 10px; border: 1px solid #27ae60; border-radius: 4px; background-color: #f2fff2;">
                    <strong>Payment successful!</strong> Redirecting to confirmation page...
                </div>
            `;
        }
    </script>
</body>
</html>
