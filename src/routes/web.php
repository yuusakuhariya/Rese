<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
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


// ホーム画面（全店舗）
Route::get('/', [ShopController::class, 'shop_all'])->name('shop_all');

// 検索機能
Route::get('/search', [shopController::class, 'shop_all'])->name('search');

// メニュー画面（１、２）
Route::get('/menu_2', [MenuController::class, 'menu_2'])->name('menu_2');
Route::get('/menu_1', [MenuController::class, 'menu_1'])->name('menu_1');

// 詳細と予約ページ表示（詳細）
Route::get('/shop/{id}', [ReservationController::class, 'shop_detail'])->name('shop_detail');
Route::post('/done', [ReservationController::class, 'store'])->name('store');

// 評価保存機能（実装するときの参考にする）
// Route::post('/reservation/{id}/evaluation', [ReservationController::class, 'storeEvaluation'])->name('storeEvaluation');

// マイページ
Route::get('/my_page/{id}', [MypageController::class, 'my_page'])->name('my_page');

// お気に入り追加・削除
Route::put('/favorite/{id}/{user_id}/{shop_id}', [FavoriteController::class, 'addFavorite'])->name('addFavorites');
Route::delete('/unfavorite/{id}/{user_id}/{shop_id}', [FavoriteController::class, 'removeFavorite'])->name('removeFavorites');



// Fortifyのデフォルトログインと登録のルート
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});