<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('front.payment.form');
    }

    public function makePayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $token = $request->input('stripeToken');
        try {
        $charge = Charge::create([
            'amount' => 1000, // amount in cents
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);

        // Handle successful payment
        $this->sendConfirmationEmail(auth()->user(), $charge->id);
        return redirect('/')->with('success', 'Payment made successfully!');

    } catch (\Stripe\Exception\CardException $e) {
        // Payment failed, handle the exception
        return redirect('/')->with('error', $e->getMessage());
    }
    }

    private function sendConfirmationEmail($user, $paymentId)
    {
        // Customize this function to send a confirmation email to the user
        // You may use Laravel's built-in Mail facade
        Mail::to($user->email)->send(new PaymentConfirmationMail($paymentId));
    }
}
