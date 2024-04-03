<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Models\Reservation;

class ReservationListController extends Controller
{
    public function reservationList()
    {
        $user = auth()->user();
        $shops = Shop::where('user_id', $user->id)->get();
        $reservations = Reservation::whereIn('shop_id', $shops)->with('user')->get();

        return view('reservationList', compact('user', 'shops', 'reservations'));
    }
}
