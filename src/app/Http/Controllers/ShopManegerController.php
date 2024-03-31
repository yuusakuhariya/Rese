<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;


class ShopManegerController extends Controller
{
    public function shopStore(Request $request)
    {
        $area_name = $request->area_name;
        $genre_name = $request->genre_name;

        $area = Area::firstOrCreate(['area_name' => $area_name]);
        $genre = Genre::firstOrCreate(['genre_name' => $genre_name]);

        Shop::create([
            'shop_name' => $request->shop_name,
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'content' => $request->content,
            'imag_path' => $request->file('imag_path')->store('public/'),
        ]);
        return redirect()->back();
    }
}
