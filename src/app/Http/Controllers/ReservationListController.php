<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Pagination\Paginator;

class ReservationListController extends Controller
{
    public function reservationList()
    {
        $user = auth()->user();
        $shops = Shop::where('user_id', $user->id)->get();
        $reservations = Reservation::whereIn('shop_id', $shops)->with('user')->paginate(10);

        return view('reservationList', compact('user', 'shops', 'reservations'));
    }
}
