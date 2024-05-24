<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reservation;


class MypageController extends Controller
{
    public function myPage()
    {
        $user = auth()->user();

        $reservations = Reservation::where('user_id', $user->id)
            ->with('shop')
            ->get();

        $favorites = Favorite::where('user_id', $user->id)
            ->with('shop.area', 'shop.genre')
            ->get();

        return view('myPage', compact('reservations', 'user', 'favorites'));
    }
}
