<?php

namespace App\Http\Controllers;

class MenuController extends Controller
{
    public function homeMenu()
    {
        $prevurl = url()->previous();
        return view('homeMenu', compact('prevurl'));
    }

    public function loginMenu()
    {
        $prevurl = url()->previous();
        return view('loginMenu', compact('prevurl'));
    }


    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function myPage()
    {
        return view('myPage');
    }


    public function shopManegerMenu()
    {
        return view('shopManegerMenu');
    }

    public function reservationListMenu()
    {
        return view('reservationListMenu');
    }

    public function adminMenuUserListMail()
    {
        return view('adminMenuUserListMail');
    }

    public function adminMenuShopRegisterMail()
    {
        return view('adminMenuShopRegisterMail');
    }

    public function adminMenuShopRegisterUserList()
    {
        return view('adminMenuShopRegisterUserList');
    }
}