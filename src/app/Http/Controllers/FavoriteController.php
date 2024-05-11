<?php

namespace App\Http\Controllers;

class FavoriteController extends Controller
{
    public function addFavorite($userId)
    {
        $user = auth()->user();
        $user->favorite($userId);

        return redirect()->back();
    }

    public function removeFavorite($userId)
    {
        $user = auth()->user();
        $user->unfavorite($userId);
        return redirect()->back();
    }
}
