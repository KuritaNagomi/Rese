<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Token;
use Stripe\Plan;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment_confirm');
    }

    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function charge(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {

            $charge = Charge::create([
                'amount' => $request->amount,
                'currency' => 'jpy',
                'source' => 'tok_visa',
                'description' => 'Test payment',
            ]);

            return redirect()->route('my_page')->with('message', '支払いが完了しました');

        } catch (\Exception $e) {
            return redirect()->route('payment.form')->withErrors(['エラーが発生しました' => $e->getMessage()]);
        }
    }
}
