@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-check-circle me-2"></i>
                        Payment Successful!
                    </h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <strong>Thank you!</strong> Your payment has been processed successfully.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Payment Details</h5>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Order ID:</strong></td>
                                    <td>{{ $order_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Amount Paid:</strong></td>
                                    <td>${{ number_format($payment->amount / 100, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Payment ID:</strong></td>
                                    <td>{{ $payment->payment_intent_id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h5>Enrollment Details</h5>
                            <table class="table table-sm">
                                @if($classId)
                                <tr>
                                    <td><strong>Subject:</strong></td>
                                    <td>{{ $classId->name }}</td>
                                </tr>
                                @endif
                                @if($tutorname)
                                <tr>
                                    <td><strong>Tutor:</strong></td>
                                    <td>{{ $tutorname->name }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>What's Next?</h5>
                        <ul>
                            <li>You will receive a confirmation email shortly</li>
                            <li>Your tutor will contact you to schedule sessions</li>
                            <li>Check your dashboard for upcoming classes</li>
                        </ul>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary me-3">
                            <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home me-2"></i>Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
