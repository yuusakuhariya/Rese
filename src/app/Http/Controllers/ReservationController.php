<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // 詳細と予約ページ（詳細）
    public function show($shop_id)
    {
        // ログイン判定
        $isAuthenticated = auth()->check();
        // $shop_idで指定されたIDを持つShopモデルをデータベースから検索。findOrFailメソッドはエラーをスルーする。
        $shop = Shop::findOrFail($shop_id);

        return view('shop_detail', compact('shop', 'isAuthenticated'));
    }

    public function store(Request $request)
    {
        // ユーザーがログインしていることを確認
        if (auth()->check()) {
            // ログインしているユーザーの ID を取得
            $user_id = auth()->user()->id;

            // 予約を作成して保存
            $reservation = new Reservation();
            $reservation->user_id = $user_id;
            $reservation->shop_id = $request->shop_id;
            $reservation->date = $request->date;
            $reservation->time = $request->time;
            $reservation->number_of_person = $request->number_of_person;
            $reservation->save();

            return view('done');
        }
    }
}
