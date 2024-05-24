<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\URL;

class QRCodeController extends Controller
{
    public function generateQRCode(Request $request)
    {
        $reservationId = $request->input('id');
        $reservation = Reservation::find($reservationId);

        if ($reservation && $reservation->is_visited == 0) {
            $url = URL::to("/reservations/{$reservation->id}");
            $qrCode = QrCode::size(250)->generate($url);
            return view('QRCode', ['qrCode' => $qrCode]);
        } else {
            return redirect()->back();
        }
    }
}
