<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationFormRequest;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Http\Request;

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
    public function update(Request $request)
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



    // 評価機能（実装するときの参考にする）
    // public function show($id)
    // {
    //     $reservation = Reservation::findOrFail($id);

    //     // 予約が来店済みかどうかをチェック
    //     if ($reservation->visited) {
    //         // 評価フォームを表示
    //         return view('reservation.show', compact('reservation'));
    //     } else {
    //         // エラーメッセージを表示して、評価を受け付けない
    //         return back()->with('error', '予約が来店済みではありません。');
    //     }
    // }

    // public function storeEvaluation(Request $request, $id)
    // {
    //     // ユーザーがログインしているかどうかを確認
    //     if (!auth()->check()) {
    //         return back()->with('error', 'ログインが必要です。'); // ログインしていない場合はエラーメッセージを返す
    //     }

    //     $reservation = Reservation::findOrFail($id);

    //     // 予約が来店済みかどうかを再度確認
    //     if ($reservation->visited) {
    //         // 評価を保存
    //         Evaluation::create([
    //             'reservation_id' => $reservation->id,
    //             'score' => $request->score,
    //             'comment' => $request->comment,
    //             'user_id' => auth()->user()->id,
    //         ]);

    //         // 成功メッセージを表示
    //         return back()->with('success', '評価が受け付けられました。');
    //     } else {
    //         // エラーメッセージを表示して、評価を受け付けない
    //         return back()->with('error', '予約が来店済みではありません。');
    //     }
    // }
}
