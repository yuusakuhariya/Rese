<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
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

Route::get('/', [MenuController::class, 'shop_all'])->name('shop_all');
Route::get('/menu_2', [MenuController::class, 'menu_2'])->name('menu_2');
Route::get('/menu_1', [MenuController::class, 'menu_1'])->name('menu_1');
Route::get('/shop_detail', [MenuController::class, 'shop_detail'])->name('shop_detail');
Route::get('/my_page', [MenuController::class, 'my_page'])->name('my_page');

// Fortifyのデフォルトログインと登録のルート
Route::middleware('guest')->group(function () {
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
});