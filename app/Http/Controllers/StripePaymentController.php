<?php
      
namespace App\Http\Controllers;
       
use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
       
class StripePaymentController extends Controller
{
    public function stripe(): View
    {
        return view('stripe');
    }
    
    public function stripePost(Request $request): RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $amt = $request->amt;
        $response =  Stripe\Charge::create ([
                    "amount" => $amt * 100,
                    "currency" => "gbp",
                    "source" => $request->stripeToken,
                    "description" => "My Choice Tutor" 
            ]);
 
        if($response->status == "succeeded"){
            $order_id = $response->id;
            $orderId = session('order_id');     
            return redirect()->route('stripe.payment.success')->with('order_id', $order_id);
        }else{
            return back()->with('success', 'Payment Failed!');
        }
    }
}