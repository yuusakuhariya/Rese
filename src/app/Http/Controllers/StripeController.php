<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use App\Models\User;
use App\Models\Reservation;

class StripeController extends Controller
{
    public function charge(Request $request)
    {
        $userId = auth()->user()->id;
        $user = User::findOrFail($userId);
        $reservation = Reservation::findOrFail($request->id);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Charge::create(array(
            'amount' => 100,
            'currency' => 'jpy',
            'source' => $request->stripeToken,
        ));

        $user->pm_type = $charge->payment_method_details->type;
        $user->pm_last_four = $charge->payment_method_details->card->last4;
        $stripeCustomer = Customer::create([
            'email' => $user->email,
        ]);

        $user->stripe_id = $stripeCustomer->id;
        $user->save();

        $paymentId = $charge->id;
        $reservation->payment_status = 'paid';
        $reservation->payment_reference = $paymentId;
        $reservation->save();

        return redirect()->back();
    }
}
