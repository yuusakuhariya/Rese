<?php

namespace App\Http\Controllers;


use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationFormRequest;

class ReservationController extends Controller
{
    public function shopDetail($shop_id)
    {
        $user = auth()->user();
        $shop = Shop::find($shop_id);
        return view('shop_detail', compact('shop', 'user'));
    }

    public function store(ReservationFormRequest $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        Reservation::create([
            'user_id' => $user->id,
            'shop_id' => $request->shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'number_of_person' => $request->number_of_person,
            'price' => $request->price,
        ]);
        return view('done');
    }

    public function delete(Request $request)
    {
        Reservation::find($request->id)->delete();
        return redirect()->back();
    }

    public function update(ReservationFormRequest $request)
    {
        $reservationId = $request->id;

        Reservation::where('id', $reservationId)->update([
            'date' => $request->date,
            'time' => $request->time,
            'number_of_person' => $request->number_of_person,
            'price' => $request->price,
        ]);
        return redirect()->back();
    }

    public function checkQRcode($id)
    {
        $reservation = Reservation::find($id);

        if ($reservation) {
            $reservation->is_visited = true;
            $reservation->save();
            return view('auth.login');
        }
    }
}
