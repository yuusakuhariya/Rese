<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menu_2()
    {
        $prevurl = url()->previous();
        return view('menu_2', compact('prevurl'));
    }

    public function menu_1()
    {
        $prevurl = url()->previous();
        return view('menu_1', compact('prevurl'));
    }


    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function my_page()
    {
        return view('my_page');
    }
}
