<?php

namespace App\Http\Controllers;

class MenuController extends Controller
{
    public function homeMenu()
    {
        return view('homeMenu');
    }

    public function loginMenu()
    {
        return view('loginMenu');
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