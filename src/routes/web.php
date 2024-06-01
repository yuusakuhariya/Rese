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
use App\Http\Controllers\MailController;
use App\Http\Controllers\ReservationListController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\QRCodeController;

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





Route::get('/', [ShopController::class, 'shopAll'])->name('shopAll');
Route::get('/search', [ShopController::class, 'shopAll'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/home', [ShopController::class, 'shopAll'])->name('loginShopAll');
    Route::get('/loginSearch', [ShopController::class, 'shopAll'])->name('loginSearch');
    Route::get('/shopList', [ShopController::class, 'shopList'])->name('shopList');
    Route::get('/admin', [ShopController::class, 'admin'])->name('admin');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::get('/userSearch', [AdminController::class, 'adminUserList'])->name('userSearch');
Route::get('/adminUserList', [AdminController::class, 'adminUserList'])->name('adminUserList');
Route::post('/userCreate', [AdminController::class, 'userStore'])->name('userStore');
Route::delete('/userDelete/{id}', [AdminController::class, 'userDelete'])->name('userDelete');
Route::get('/adminMail', [AdminController::class, 'adminMail'])->name('adminMail');

Route::get('/shopStore', [ShopManegerController::class, 'shopStore'])->name('shopStore');
Route::post('/shopCreate', [ShopManegerController::class, 'shopCreate'])->name('shopCreate');
Route::get('/shopUpdate/{id}', [ShopManegerController::class, 'shopUpdate'])->name('shopUpdate');
Route::put('/shopRenew', [ShopManegerController::class, 'shopRenew'])->name('shopRenew');
Route::get('/shopMgReservationList/{id}', [ShopManegerController::class, 'shopManegerReservationList'])->name('shopManegerReservationList');

Route::get('/homeMenu', [MenuController::class, 'homeMenu'])->name('homeMenu');
Route::get('/loginMenu', [MenuController::class, 'loginMenu'])->name('loginMenu');
Route::get('/shopMgMenu', [MenuController::class, 'shopManegerMenu'])->name('shopManegerMenu');
Route::get('/adminMenuUserListMail', [MenuController::class, 'adminMenuUserListMail'])->name('adminMenuUserListMail');
Route::get('/adminMenuShopRegisterMail', [MenuController::class, 'adminMenuShopRegisterMail'])->name('adminMenuShopRegisterMail');
Route::get('/adminMenuShopRegisterUserList', [MenuController::class, 'adminMenuShopRegisterUserList'])->name('adminMenuShopRegisterUserList');

Route::get('/shop/{id}', [ReservationController::class, 'shopDetail'])->name('shopDetail');
Route::post('/done', [ReservationController::class, 'store'])->name('store');
Route::delete('/delete/{id}', [ReservationController::class, 'delete'])->name('delete');
Route::put('/update/{id}', [ReservationController::class, 'update'])->name('update');

Route::get('/myPage/{id}', [MypageController::class, 'myPage'])->name('myPage');

Route::get('/review/{id}', [ReviewController::class, 'review'])->name('review');
Route::post('/posting', [ReviewController::class, 'reviewStore'])->name('reviewStore');

Route::put('/favorite/{id}/{user_id}/{shop_id}', [FavoriteController::class, 'addFavorite'])->name('addFavorites');
Route::delete('/unfavorite/{id}/{user_id}/{shop_id}', [FavoriteController::class, 'removeFavorite'])->name('removeFavorites');

Route::post('/sendNotification', [MailController::class, 'sendNotification'])->name('send.notification');

Route::post('/charge', [StripeController::class, 'charge'])->name('stripe.charge');

Route::get('/generateQRCode', [QRCodeController::class, 'generateQRCode'])->name('QRCode');

Route::get('/reservations/{id}', [ReservationController::class, 'checkQRcode'])->name('checkQRcode');

