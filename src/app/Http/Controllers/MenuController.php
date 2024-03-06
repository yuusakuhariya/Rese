<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function shop_all()
    {
        $isAuthenticated = auth()->check();
        return view('shop_all', compact('isAuthenticated'));
    }

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

    public function shop_detail()
    {
        $isAuthenticated = auth()->check();
        return view('shop_detail', compact('isAuthenticated'));
    }

    public function my_page()
    {
        return view('my_page');
    }
}
