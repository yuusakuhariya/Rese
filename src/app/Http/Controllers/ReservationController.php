<?php

namespace App\Http\Controllers;


use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationFormRequest;

class ReservationController extends Controller
{
    // 詳細と予約ページ（詳細）
    public function shop_detail($shop_id)
    {
        // ログイン判定
        $user = auth()->user();
        // $shop_idで指定されたIDを持つShopモデルをデータベースから検索。
        $shop = Shop::find($shop_id);

        return view('shop_detail', compact('shop', 'user'));
    }

    // 追加
    public function store(ReservationFormRequest $request)
    {
        // ログインしていない場合はログインページへ
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // ログイン判定
        $user = auth()->user();

        // 予約情報追加
        Reservation::create([
            'user_id' => $user->id,
            'shop_id' => $request->shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'number_of_person' => $request->number_of_person
        ]);
        return view('done');
    }

    // 削除
    public function delete(Request $request)
    {
        Reservation::find($request->id)->delete();

        return redirect()->back();
    }

    // 更新
    public function update(ReservationFormRequest $request)
    {
        // リクエストから予約のIDを取得
        $reservationId = $request->id;

        // リクエストから更新するデータを取得し、Reservationモデルを更新する
        Reservation::where('id', $reservationId)->update([
            'date' => $request->date,
            'time' => $request->time,
            'number_of_person' => $request->number_of_person,
        ]);

        return redirect()->back();
    }
}
