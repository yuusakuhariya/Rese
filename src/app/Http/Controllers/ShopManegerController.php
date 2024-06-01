<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Http\Requests\ShopManegerFormRequest;


class ShopManegerController extends Controller
{
    public function shopStore()
    {
        $user = auth()->user();
        $shops = Shop::with('Area', 'Genre')->where('user_id', $user->id)->get();
        return view('shopManegerStore', compact('shops'));
    }

    public function shopCreate(ShopManegerFormRequest $request)
    {
        $user = auth()->user();
        $area_name = $request->area_name;
        $genre_name = $request->genre_name;
        $area = Area::firstOrCreate(['area_name' => $area_name]);
        $genre = Genre::firstOrCreate(['genre_name' => $genre_name]);

        Shop::create([
            'shop_name' => $request->shop_name,
            'user_id' => $user->id,
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'content' => $request->content,
            'img_path' => $request->file('img_path')->store('public/images'),
        ]);
        return redirect()->back()->with('success', '新しい店舗が作成されました。');
    }


    public function shopUpdate($id)
    {
        $user = auth()->user();
        $shop = Shop::with('Area', 'Genre')->where('user_id', $user->id)->where('id', $id)->first();
        return view('shopManegerUpdate', compact('shop'));
    }

    public function shopRenew(ShopManegerFormRequest $request)
    {
        $area_name = $request->area_name;
        $genre_name = $request->genre_name;
        $area = Area::firstOrCreate(['area_name' => $area_name]);
        $genre = Genre::firstOrCreate(['genre_name' => $genre_name]);
        $shopId = $request->id;

        shop::where('id', $shopId)->update([
            'shop_name' => $request->shop_name,
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'content' => $request->content,
            'img_path' => $request->file('img_path')->store('public/images'),
        ]);

        return redirect()->back();
    }

    public function shopManegerReservationList($id)
    {
        $user = auth()->user();
        $shops = Shop::where('user_id', $user->id)->where('id', $id)->get();
        $reservations = Reservation::whereIn('shop_id', $shops)->with('user')->paginate(10);

        return view('shopManegerReservationList', compact('user', 'shops', 'reservations'));
    }

}
