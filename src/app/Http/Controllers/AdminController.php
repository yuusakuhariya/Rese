<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
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
        return redirect()->back()->with('success', '登録が完了しました。');
    }

    public function userDelete(Request $request)
    {
        User::find($request->id)->delete();

        return redirect()->back();
    }


    public function adminUserList(Request $request)
    {
        $userSearches = User::RoleSearch($request->role)->KeywordSearch($request->keyword)->paginate(10);
        return view('admin-userList', compact('userSearches'));
    }

    public function adminMail()
    {
        $user = auth()->user();
        $users = User::get();

        return view('admin-mail', compact('user', 'users'));
    }
}
