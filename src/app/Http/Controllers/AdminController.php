<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\AdminFormRequest;

class AdminController extends Controller
{
    public function userStore(AdminFormRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->back();
    }

    public function userDelete(Request $request)
    {
        User::find($request->id)->delete();

        return redirect()->back();
    }
}
