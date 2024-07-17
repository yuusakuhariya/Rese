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
            if ($request->has('keyword')) {
                $searchShops = Shop::with('Genre', 'Area', 'Review')->areaSearch($request->area_id)->genreSearch($request->genre_id)->keywordSearch($request->keyword)->get();
                foreach ($searchShops as $shop) {
                    if ($shop->Review->isNotEmpty()) {
                        $averageRating = $shop->Review->avg('rating');
                        $shop->Review->rating = number_format($averageRating, 1);
                        $shop->Review->comment = $shop->Review->count('comment');
                    } else {
                        $shop->Review->rating = 0;
                        $shop->Review->comment = 0;
                    }
                }
            } else {
                $searchShops = null;
            }

            $sort = $request->get('sort');
            $query = Shop::with('Area', 'Genre', 'Review');

            $allShopLists = $query->get()->map(function ($shop) {
                if ($shop->Review->isNotEmpty()) {
                    $averageRating = $shop->Review->avg('rating');
                    $shop->average_rating = number_format($averageRating, 1);
                } else {
                    $shop->average_rating = null;
                }
                return $shop;
            });

            $noReviewShops = $allShopLists->whereNull('average_rating');
            $allShopLists = $allShopLists->whereNotNull('average_rating');
            $allShopLists = $allShopLists->concat($noReviewShops);

            switch ($sort) {
                case 'area':
                    $allShopLists = $allShopLists->sortBy('area_id');
                    break;
                case 'genre':
                    $allShopLists = $allShopLists->sortBy('genre_id');
                    break;
                case 'high_to_low':
                    $allShopLists = $allShopLists->sortByDesc('average_rating');
                    break;
                case 'low_to_high':
                    $allShopLists = $allShopLists->sortBy('average_rating');
                    break;
                case 'random':
                    $allShopLists = $allShopLists->shuffle();
                    break;
                case 'shop_name_asc':
                    // 店舗名の昇順（あいうえお順）にソート(カラムにフリガナ追加しないとできない)
                    $allShopLists = $allShopLists->sortBy('shop_name', SORT_LOCALE_STRING);
                    break;
                default:
                    break;
            }

            $noReviewShops = $allShopLists->whereNull('average_rating');
            $allShopLists = $allShopLists->whereNotNull('average_rating');
            $allShopLists = $allShopLists->concat($noReviewShops);

            foreach ($allShopLists as $shop) {
                $shop->comment_count = $shop->Review->count('comment');
            }


            $allGenres = Genre::all();
            $allAreas = Area::all();
            return view('shop_all', compact('user', 'favoriteShopIds', 'searchShops', 'allShopLists', 'allGenres', 'allAreas'));

        } elseif (Gate::allows('shop')) {
            $user = auth()->user();
            $shops = Shop::with('Area', 'Genre')->where('user_id', $user->id)->get();
            return view('shop_maneger_shop_list', compact('shops'));

        } elseif (Gate::allows('admin')) {
            $users = User::where('role', 'shop')->get();
            $userSearches = User::roleSearch($request->role)->keywordSearch($request->keyword)->get();
            return view('admin',compact('users'));
        }


        if ($request->has('keyword')) {
            $searchShops = Shop::with('Genre', 'Area','Review')->areaSearch($request->area_id)->genreSearch($request->genre_id)->KeywordSearch($request->keyword)->get();
            foreach ($searchShops as $shop) {
                if ($shop->Review->isNotEmpty()) {
                    $averageRating = $shop->Review->avg('rating');
                    $shop->Review->rating = number_format($averageRating, 1);
                    $shop->Review->comment = $shop->Review->count('comment');
                } else {
                    $shop->Review->rating = 0;
                    $shop->Review->comment = 0;
                }
            }
        } else {
            $searchShops = null;
        }

        $sort = $request->get('sort');
        $query = Shop::with('Area', 'Genre', 'Review');

        $allShopLists = $query->get()->map(function ($shop) {
            if ($shop->Review->isNotEmpty()) {
                $averageRating = $shop->Review->avg('rating');
                $shop->average_rating = number_format($averageRating, 1);
            } else {
                $shop->average_rating = null;
            }
            return $shop;
        });

        $noReviewShops = $allShopLists->whereNull('average_rating');
        $allShopLists = $allShopLists->whereNotNull('average_rating');
        $allShopLists = $allShopLists->concat($noReviewShops);

        switch ($sort) {
            case 'area':
                $allShopLists = $allShopLists->sortBy('area_id');
                break;
            case 'genre':
                $allShopLists = $allShopLists->sortBy('genre_id');
                break;
            case 'high_to_low':
                $allShopLists = $allShopLists->sortByDesc('average_rating')->values();
                break;
            case 'low_to_high':
                $allShopLists = $allShopLists->sortBy('average_rating')->values();
                break;
            case 'random':
                $allShopLists = $allShopLists->shuffle();
                break;
            case 'shop_name_asc':
                // 店舗名の昇順（あいうえお順）にソート(カラムにフリガナ追加しないとできない)
                $allShopLists = $allShopLists->sortBy('shop_name');
                break;
            default:
                break;
        }

        $noReviewShops = $allShopLists->whereNull('average_rating');
        $allShopLists = $allShopLists->whereNotNull('average_rating');
        $allShopLists = $allShopLists->concat($noReviewShops);

        foreach ($allShopLists as $shop) {
            $shop->comment_count = $shop->Review->count('comment');
        }

        $allGenres = Genre::all();
        $allAreas = Area::all();
        return view('shop_all', compact('user', 'favoriteShopIds', 'searchShops', 'allShopLists', 'allGenres', 'allAreas'));
    }
}
