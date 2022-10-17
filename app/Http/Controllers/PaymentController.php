<?php

namespace App\Http\Controllers;

class PaymentController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function seesion()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'gbp',
                        'product_data' => [
                            'name' => 'gimme money!!!!',
                        ],
                        'unit_amount'  => 500,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success'),
            'cancel_url'  => route('checkout'),
        ]);
        return redirect()->away($session->url);
    }

    public function success()
    {
        return "Yay, It works!!!";
    }
}
