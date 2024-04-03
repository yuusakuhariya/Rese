<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Http\Requests\ShopManegerFormRequest;


class ShopManegerController extends Controller
{
    public function shopStore(ShopManegerFormRequest $request)
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
        return redirect()->back();
    }

    public function shopUpdate(ShopManegerFormRequest $request)
    {

        $area_name = $request->area_name;
        $genre_name = $request->genre_name;

        $area = Area::firstOrCreate(['area_name' => $area_name]);
        $genre = Genre::firstOrCreate(['genre_name' => $genre_name]);

        // リクエストから予約のIDを取得
        $shopId = $request->id;

        // リクエストから更新するデータを取得し、Reservationモデルを更新する
        shop::where('id', $shopId)->update([
            'shop_name' => $request->shop_name,
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'content' => $request->content,
            'img_path' => $request->file('img_path')->store('public/images'),
        ]);

        return redirect()->back();
    }

}
