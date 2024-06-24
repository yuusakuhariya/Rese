<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


class ShopController extends Controller
{
    public function shopAll(Request $request)
    {
        $user = auth()->user();

        if ($user) {
            $favoriteShopIds = auth()->user()->favorites->pluck('id')->all();
        } else {
            $favoriteShopIds = [];
        }

        if (Gate::allows('user')) {
            $AllShopLists = Shop::with('Area', 'Genre')->get();
            $AllGenres = Genre::all();
            $AllAreas = Area::all();

            if ($request->has('keyword')) {
                $searchShops = Shop::with('genre', 'area')->AreaSearch($request->area_id)->GenreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();
            } else {
                $searchShops = null;
            }
            return view('shop_all', compact('user', 'favoriteShopIds', 'searchShops', 'AllShopLists', 'AllGenres', 'AllAreas'));

        } elseif (Gate::allows('shop')) {
            $user = auth()->user();
            $shops = Shop::with('Area', 'Genre')->where('user_id', $user->id)->get();
            return view('shop_maneger_shop_list', compact('shops'));

        } elseif (Gate::allows('admin')) {
            $userSearches = User::RoleSearch($request->role)->KeywordSearch($request->keyword)->get();
            return view('admin');
        }


        if ($request->has('keyword')) {
            $searchShops = Shop::with('genre', 'area')->AreaSearch($request->area_id)->GenreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();
        } else {
            $searchShops = null;
        }

        $AllShopLists = Shop::with('Area', 'Genre')->get();
        $AllGenres = Genre::all();
        $AllAreas = Area::all();
        return view('shop_all', compact('user', 'favoriteShopIds', 'searchShops', 'AllShopLists', 'AllGenres', 'AllAreas'));
    }
}
