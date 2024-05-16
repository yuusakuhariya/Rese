<?php

namespace App\Http\Controllers;

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


    public function shopManegerMenu()
    {
        return view('shopManegerMenu');
    }

    public function reservationListMenu()
    {
        return view('reservationListMenu');
    }

    public function adminMenu_1()
    {
        return view('adminMenu_1');
    }

    public function adminMenu_2()
    {
        return view('adminMenu_2');
    }

    public function adminMenu_3()
    {
        return view('adminMenu_3');
    }
}