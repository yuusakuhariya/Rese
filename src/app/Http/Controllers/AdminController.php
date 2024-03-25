<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function userSearch(Request $request)
    {
        $userSearches = User::RoleSearch($request->role)->KeywordSearch($request->keyword)->get();

        return view('admin', compact('userSearches'));
    }
}
