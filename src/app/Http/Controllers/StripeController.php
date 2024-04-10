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
        // ログインしているユーザー
        $userId = auth()->user()->id;
        // ユーザーテーブルからログインしているユーザーを検索
        $user = User::findOrFail($userId);
        // リクエストしたIDを予約テーブルから検索
        $reservation = Reservation::findOrFail($request->id);

        //シークレットキー
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Charge::create(array(
            'amount' => 100,
            'currency' => 'jpy',
            'source' => $request->stripeToken,
        ));

        // 支払いが成功した場合、ユーザーテーブルに支払い情報を保存
        $user->pm_type = $charge->payment_method_details->type;
        $user->pm_last_four = $charge->payment_method_details->card->last4;
        // Stripeの顧客を作成
        $stripeCustomer = Customer::create([
            'email' => $user->email, // ユーザーのメールアドレスを使用して顧客を作成
            // 他の顧客情報を追加する場合はここに追加
        ]);

        // ユーザーテーブルにStripeの顧客IDを保存
        $user->stripe_id = $stripeCustomer->id;
        $user->save();


        // 支払いIDを変数に代入
        $paymentId = $charge->id;

        // 予約に支払い情報を関連付ける
        $reservation->payment_status = 'paid';
        $reservation->payment_reference = $paymentId;
        // Stripeの支払いIDを保存
        $reservation->save();

        return redirect()->back();
    }
}
