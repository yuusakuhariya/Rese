<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopManegerController;
// use App\Http\Controllers\RoleController;
use App\Models\Favorite;
use App\Models\Reservation;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// 店検索機能
Route::get('/search', [ShopController::class, 'shop_all'])->name('search');


// ユーザー検索機能
Route::get('/user_search', [ShopController::class, 'shop_all'])->name('userSearch');
// 管理者からの店代表者登録
Route::post('/user_create', [AdminController::class, 'userStore'])->name('userStore');
// ユーザー削除
Route::delete('/user_delete/{id}', [AdminController::class, 'userDelete'])->name('userDelete');

Route::post('/shop_create', [ShopManegerController::class, 'shopStore'])->name('shopStore');


// メニュー画面（１、２）
Route::get('/menu_2', [MenuController::class, 'menu_2'])->name('menu_2');
Route::get('/menu_1', [MenuController::class, 'menu_1'])->name('menu_1');

// 詳細と予約ページ表示（詳細）
Route::get('/shop/{id}', [ReservationController::class, 'shop_detail'])->name('shop_detail');
// 予約追加
Route::post('/done', [ReservationController::class, 'store'])->name('store');
// 予約削除
Route::delete('/delete/{id}', [ReservationController::class, 'delete'])->name('delete');
// 予約更新
Route::put('/update/{id}', [ReservationController::class, 'update'])->name('update');


// マイページ
Route::get('/my_page/{id}', [MypageController::class, 'my_page'])->name('my_page');

// 評価ページ
Route::get('/review/{id}', [ReviewController::class, 'review'])->name('review');
// レビュー追加
Route::post('/posting', [ReviewController::class, 'reviewStore'])->name('review-store');

// お気に入り追加・削除
Route::put('/favorite/{id}/{user_id}/{shop_id}', [FavoriteController::class, 'addFavorite'])->name('addFavorites');
Route::delete('/unfavorite/{id}/{user_id}/{shop_id}', [FavoriteController::class, 'removeFavorite'])->name('removeFavorites');



// ログインと登録のルート
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// ログインした店舗管理者のみがアクセス可能なルート
Route::middleware('auth')->group(function () {
    Route::get('/shopManeger', [ShopController::class, 'shopManeger'])->name('shopManeger');
    Route::get('/admin', [ShopController::class, 'admin'])->name('admin');
});


// ホーム画面（全店舗）
Route::get('/', [ShopController::class, 'shop_all'])->name('shop_all');
