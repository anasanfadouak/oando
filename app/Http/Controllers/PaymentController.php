<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->totalvalue
                    ]
                ]
            ]
        ]);
        // Save the product and total value to the session
     session(['products' => $request->items]);
     session(['totalvalue' => $request->totalvalue]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function paymentCancel()
    {
        
        return redirect()
            ->route('cart.show')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // Get the products from the session
        $products = session('products');
        $totalValue = session('totalvalue');

        // Create a new order
        $order = new Order;
        $order->order_date = now();
        $order->products = json_encode($products); // Save the products as a JSON string
        $order->total = $totalValue;
        $order->save();

        // clear the session
        session()->forget('products');
        session()->forget('totalvalue');

            return redirect()
                ->route('cart.show')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('cart.show')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $amountInDollars = $request->totalvalue;
        $amountInCents = round($amountInDollars * 100);
        
    
        // Create a new order
        $order = new Order;
        $order->order_date = now();
        $order->products = json_encode($request->items); // Save the products as a JSON string
        $order->total = $request->totalvalue;
        $order->save();
        $charge = Charge::create([
            'amount' => $amountInCents, // amount in cents
            'currency' => 'usd', // change to your preferred currency
            'source' => $request->stripeToken,
            'description' => 'Example charge',
        ]);

        return back()->with('success', 'Payment was successful.');
    }
}
