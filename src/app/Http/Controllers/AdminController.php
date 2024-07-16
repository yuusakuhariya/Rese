<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Review;
use App\Http\Requests\AdminFormRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ShopsImport;
use Maatwebsite\Excel\Validators\ValidationException;


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

    public function adminReviewList(Request $request)
    {
        $reviews = Review::with('shop', 'user')->ReviewSearch($request->shop_id)->KeywordSearch($request->keyword)->paginate(10);
        if ($reviews->isEmpty()) {
            $reviews = Review::with('shop', 'user')->paginate(10);
        }

        return view('admin_review_list', compact('reviews'));
    }

    public function adminReviewDelete(request $request)
    {
        Review::find($request->id)->delete();
        return redirect()->back();
    }

    public function csvImportShop(Request $request)
    {
        try {
            $userId = $request->select_user;
            $file = $request->file('shop');

            Excel::import(new ShopsImport($userId), $file);

            return back()->with('success', 'CSVファイルのインポートに成功しました。');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];
            foreach ($failures as $failure) {
                $errorMessages[] = "{$failure->row()} 行目、列:{$failure->attribute()}: " . implode(', ', $failure->errors());
            }
            return back()->with('error', 'インポート中にバリデーションエラーが発生しました。')->with('validationErrors', $errorMessages);
        } catch (\Exception $e) {
            return back()->with('error', 'インポート中にエラーが発生しました: ' . $e->getMessage());
        }
    }
}
