<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }
}
