<?php

namespace App\Http\Controllers;

class MenuController extends Controller
{
    public function homeMenu()
    {
        return view('home_menu');
    }

    public function loginMenu()
    {
        return view('login_menu');
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
        return view('my_page');
    }

    public function shopManegerMenu()
    {
        return view('shop_maneger_menu');
    }

    public function adminMenuUserListMail()
    {
        return view('admin_menu_user_list_mail');
    }

    public function adminMenuShopRegisterMail()
    {
        return view('admin_menu_shop_register_mail');
    }

    public function adminMenuShopRegisterUserList()
    {
        return view('admin_menu_shop_register_user_list');
    }
}