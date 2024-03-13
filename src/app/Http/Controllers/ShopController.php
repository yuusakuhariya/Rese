<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function shop_all()
    {
        // ログイン判定
        $isAuthenticated = auth()->check();

        // ユーザーがログインしている場合のみお気に入り情報を取得する
        if ($isAuthenticated) {
            // ログインしているユーザーのお気に入り店舗IDの配列を取得
            $favoriteShopIds = auth()->user()->favorites->pluck('id')->toArray();
        } else {
            // ログインしていない場合はお気に入り情報は空の配列とする
            $favoriteShopIds = [];
        }

        // ShopモデルとAreaモデル、Genreモデルをリレーション
        $AllShopLists = Shop::with('Area', 'Genre')->get();

        return view('shop_all', compact('isAuthenticated', 'AllShopLists', 'favoriteShopIds'));
    }
}
