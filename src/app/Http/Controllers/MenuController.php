<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function shop_all()
    {
        // ShopモデルとAreaモデル、Genreモデルをリレーション
        $AllShopLists = Shop::with('Area', 'Genre')->get();
        // ログイン判定
        $isAuthenticated = auth()->check();
        return view('shop_all', compact('isAuthenticated', 'AllShopLists'));
    }

        // 詳細と予約ページ（詳細）
        public function show($shop_id)
    {
        $isAuthenticated = auth()->check();
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
        } else {
            // ユーザーがログインしていない場合はリダイレクト
            return redirect();
        }
    }


    public function menu_2()
    {
        $prevurl = url()->previous();
        return view('menu_2', compact('prevurl'));
    }

    public function menu_1()
    {
        $prevurl = url()->previous();
        return view('menu_1', compact('prevurl'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function my_page()
    {
        return view('my_page');
    }
}
