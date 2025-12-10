<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

    class CheckoutController extends Controller
    {
        public function createCheckout(Request $request, \App\Models\Product $product)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Stripe requires cents, so multiply price by 100
        $amount = intval($product->price * 100);

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',

            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1
            ]],

            'success_url' => route('checkout.success') . '?product=' . $product->id,
            'cancel_url'  => route('checkout.cancel')  . '?product=' . $product->id,
        ]);

        return response()->json(['id' => $session->id]);
    }


    public function success()
    {
        return view('checkout.success');
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}
