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
        return view('adminUserList', compact('userSearches'));
    }

    public function adminMail()
    {
        $user = auth()->user();
        $users = User::where('role','user')->get();

        return view('adminMail', compact('user', 'users'));
    }
}
