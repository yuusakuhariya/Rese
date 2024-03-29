<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;


class MypageController extends Controller
{
    public function my_page()
    {
        $user = auth()->user();

        $reservations = Reservation::where('user_id', $user->id)
            ->with('shop')
            ->get();

        $favorites = Favorite::where('user_id', $user->id)
            ->with('shop.area', 'shop.genre')
            ->get();

        return view('my_page', compact('reservations', 'user', 'favorites'));
    }
}
