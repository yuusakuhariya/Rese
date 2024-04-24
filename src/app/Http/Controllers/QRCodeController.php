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
        // 予約のIDを取得して予約情報を取得
        $reservationId = $request->input('id');
        $reservation = Reservation::find($reservationId);
        // もし取得したidが存在し、かつ、そのidのレコードのis_visitedカラムに０が存在する場合、
        if ($reservation && $reservation->is_visited == 0) {
            // 予約情報をURI形式に変換
            $url = URL::to("/reservations/{$reservation->id}");
            // 生成したURIをQRコードに埋め込んで表示
            $qrCode = QrCode::size(250)->generate($url);
            return view('qr_code', ['qrCode' => $qrCode]);
        } else {
            // 予約情報が見つからない場合は戻る
            return redirect()->back();
        }
    }
}
