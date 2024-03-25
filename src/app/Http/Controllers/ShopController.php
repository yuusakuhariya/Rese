<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use Illuminate\Support\Facades\Gate;


class ShopController extends Controller
{
    public function shop_all(Request $request)
    {
        // ログイン判定
        $user = auth()->user();

        // ユーザーがログインしている場合のみお気に入り情報を取得する
        if ($user) {
            // ログインしているユーザーのお気に入り店舗IDの配列を取得
            $favoriteShopIds = auth()->user()->favorites->pluck('id')->all();
        } else {
            // ログインしていない場合はお気に入り情報は空の配列とする
            $favoriteShopIds = [];
        }

        // ユーザー、店舗代表者、管理者
        // 権限
        if (Gate::allows('user')) {
            $AllShopLists = Shop::with('Area', 'Genre')->get();
            $AllGenres = Genre::all();
            $AllAreas = Area::all();

            // 検索機能
            if ($request->has('keyword')) {
                $searchShops = Shop::with('genre', 'area')->AreaSearch($request->area_id)->GenreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();
            } else {
                $searchShops = null;
            }

            // 'user' 権限を持っている場合の処理
            return view('shop_all', compact('user', 'favoriteShopIds', 'searchShops', 'AllShopLists', 'AllGenres', 'AllAreas'));
        } elseif (Gate::allows('shop')) {
            // 'shop' 権限を持っている場合の処理
            return view('shopManeger');
        } elseif (Gate::allows('admin')) {
            // 'shop' 権限を持っている場合の処理
            return view('admin');
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

        return view('shop_all', compact('user', 'favoriteShopIds', 'searchShops', 'AllShopLists', 'AllGenres', 'AllAreas'));
    }
}
