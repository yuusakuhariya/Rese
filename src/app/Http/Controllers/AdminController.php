<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Review;
use App\Http\Requests\AdminFormRequest;
use App\Http\Requests\CsvImportRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ShopsImport;


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
        return view('admin_user_list', compact('userSearches'));
    }

    public function adminMail()
    {
        $user = auth()->user();
        $users = User::where('role','user')->get();

        return view('admin_mail', compact('user', 'users'));
    }

    public function adminReviewList()
    {
        $reviews = Review::with('shop', 'user')->paginate(10);
        return view('admin_review_list', compact('reviews'));
    }

    public function adminReviewDelete(request $request)
    {
        Review::find($request->id)->delete();
        return redirect()->back();
    }

    public function csvImportShop(Request $request)
    {
        // バリデーションルールを定義


        try {
            $userId = $request->select_user;
            // ファイルを取得
            $file = $request->file('shop');

            // インポートを実行
            Excel::import(new ShopsImport($userId), $file);

            // 成功メッセージを返す
            return back()->with('success', 'CSVファイルのインポートに成功しました。');
        } catch (\Exception $e) {
            // エラーメッセージを返す
            return back()->with('error', 'インポート中にエラーが発生しました: ' . $e->getMessage());
        }
    }
}
