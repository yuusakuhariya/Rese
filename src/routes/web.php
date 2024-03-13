<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;
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

// Route::get('/', [MenuController::class, 'shop_all'])->name('shop_all');
// Route::get('/menu_2', [MenuController::class, 'menu_2'])->name('menu_2');
// Route::get('/login', [MenuController::class, 'login'])->name('login');
// Route::get('/register', [MenuController::class, 'register'])->name('register');

Route::get('/', [ShopController::class, 'shop_all'])->name('shop_all');

Route::get('/menu_2', [MenuController::class, 'menu_2'])->name('menu_2');
Route::get('/menu_1', [MenuController::class, 'menu_1'])->name('menu_1');

// 詳細と予約ページ表示（詳細）
Route::get('/shop/{id}', [ReservationController::class, 'show'])->name('shop_detail');
Route::post('/done', [ReservationController::class, 'store'])->name('store');

Route::get('/my_page', [MenuController::class, 'my_page'])->name('my_page');

// お気に入り追加・削除
Route::put('/favorite/{id}/{user_id}/{shop_id}', [FavoriteController::class, 'addFavorite'])->name('addFavorites');
Route::delete('/unfavorite/{id}/{user_id}/{shop_id}', [FavoriteController::class, 'removeFavorite'])->name('removeFavorites');

Route::get('/{$shop_id}', [MenuController::class, 'favorite_feature'])->name('favorite_feature');


// Fortifyのデフォルトログインと登録のルート
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});