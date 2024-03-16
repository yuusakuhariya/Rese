<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;


class ShopController extends Controller
{
    public function shop_all(Request $request)
    {
        // ログイン判定
        $isAuthenticated = auth()->check();

        // ユーザーがログインしている場合のみお気に入り情報を取得する
        if ($isAuthenticated) {
            // ログインしているユーザーのお気に入り店舗IDの配列を取得
            $favoriteShopIds = auth()->user()->favorites->pluck('id')->all();
        } else {
            // ログインしていない場合はお気に入り情報は空の配列とする
            $favoriteShopIds = [];
        }

        // 検索機能
        if ($request->has('keyword')) {
            $searchShops = Shop::with('genre', 'area')->AreaSearch($request->area_id)->GenreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();
        } else {
            $searchShops = null;
        }

        // 全店舗リストの取得
        $AllShopLists = Shop::with('Area', 'Genre')->get();
        $AllGenres = Genre::all();
        $AllAreas = Area::all();

        return view('shop_all', compact('isAuthenticated', 'favoriteShopIds', 'searchShops', 'AllShopLists', 'AllGenres', 'AllAreas'));
    }
}
