<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review($id)
    {
        $user = auth()->user();
        $reservationId = Reservation::find($id);
        $reservationsDateTime = $reservationId->date . ' ' . $reservationId->time;

        if(now() >= $reservationsDateTime) {
            return view('review', compact('reservationId', 'user'));
        } else {
            return redirect()->back();
        }
    }

    public function reviewStore(Request $request)
    {
        $user = auth()->user();
        Review::create([
            'user_id' => $user->id,
            'shop_id' => $request->shop_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return view('posting');
    }
}
