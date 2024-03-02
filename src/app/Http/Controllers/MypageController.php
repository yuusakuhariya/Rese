<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function my_page()
    {
        return view('my_page');
    }
}
