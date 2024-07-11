<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Http\Requests\ShopManegerFormRequest;
use Illuminate\Support\Facades\Response;


class ShopManegerController extends Controller
{
    public function shopStore()
    {
        $user = auth()->user();
        $shops = Shop::with('Area', 'Genre')->where('user_id', $user->id)->get();
        return view('shop_maneger_store', compact('shops'));
    }

    public function shopCreate(ShopManegerFormRequest $request)
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
        return redirect()->back()->with('success', '新しい店舗が作成されました。');
    }


    public function shopUpdate($id)
    {
        $user = auth()->user();
        $shop = Shop::with('Area', 'Genre')->where('user_id', $user->id)->where('id', $id)->first();
        return view('shop_maneger_update', compact('shop'));
    }

    public function shopRenew(ShopManegerFormRequest $request)
    {
        $area_name = $request->area_name;
        $genre_name = $request->genre_name;
        $area = Area::firstOrCreate(['area_name' => $area_name]);
        $genre = Genre::firstOrCreate(['genre_name' => $genre_name]);
        $shopId = $request->id;

        shop::where('id', $shopId)->update([
            'shop_name' => $request->shop_name,
            'area_id' => $area->id,
            'genre_id' => $genre->id,
            'content' => $request->content,
            'img_path' => $request->file('img_path')->store('public/images'),
        ]);

        return redirect()->back();
    }

    public function shopManegerReservationList($id)
    {
        $user = auth()->user();
        $shops = Shop::where('user_id', $user->id)->where('id', $id)->get();
        $reservations = Reservation::whereIn('shop_id', $shops)->with('user')->paginate(10);

        return view('shop_maneger_reservation_list', compact('user', 'shops', 'reservations'));
    }


    public function exportCsv($id)
    {
        $user = auth()->user();
        $shops = Shop::where('user_id', $user->id)->where('id', $id)->get();
        $reservations = Reservation::whereIn('shop_id', $shops)->with('user')->get();

        $fileName = '';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['ID', 'User_id'];

        $callback = function() use($reservations, $columns) {
            $file = fopen('php://output','w');
            fputcsv($file,$columns);

            foreach ($reservations as $reservation) {
                $row =[
                    $reservation->id,
                    $reservation->user_id
                ];
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

}
