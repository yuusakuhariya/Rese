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


// ホーム画面（全店舗）
Route::get('/', [ShopController::class, 'shop_all'])->name('shop_all');
// 店検索機能
Route::get('/search', [ShopController::class, 'shop_all'])->name('search');

// ユーザー検索機能
Route::get('/user_search', [AdminController::class, 'adminUserList'])->name('userSearch');
// ユーザー一覧
Route::get('/admin-userList', [AdminController::class, 'adminUserList'])->name('adminUserList');
// 店代表者登録
Route::post('/user_create', [AdminController::class, 'userStore'])->name('userStore');
// ユーザー削除
Route::delete('/user_delete/{id}', [AdminController::class, 'userDelete'])->name('userDelete');
// 管理者からのメール送信画面
Route::get('/admin-mail', [AdminController::class, 'adminMail'])->name('adminMail');

// 店舗代表者による店舗作成
Route::post('/shop_create', [ShopManegerController::class, 'shopStore'])->name('shopStore');
// 店舗代表者による店舗更新
Route::put('/shopUpdate', [ShopManegerController::class, 'shopUpdate'])->name('shopUpdate');

// メニュー画面（１、２）
Route::get('/menu_2', [MenuController::class, 'menu_2'])->name('menu_2');
Route::get('/menu_1', [MenuController::class, 'menu_1'])->name('menu_1');
// 店舗代表者メニュー
Route::get('/shop_mg_menu', [MenuController::class, 'shopManegerMenu'])->name('shopManegerMenu');
// 予約一覧メニュー
Route::get('/reservation_list_menu', [MenuController::class, 'reservationListMenu'])->name('reservationListMenu');
// 管理者メニュー１
Route::get('/admin-menu_1', [MenuController::class, 'adminMenu_1'])->name('adminMenu_1');
// 管理者メニュー2
Route::get('/admin-menu_2', [MenuController::class, 'adminMenu_2'])->name('adminMenu_2');
// 管理者メニュー3
Route::get('/admin-menu_3', [MenuController::class, 'adminMenu_3'])->name('adminMenu_3');


// 詳細と予約ページ表示
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


// メール送信機能
Route::post('/send-notification', [MailController::class, 'sendNotification'])->name('send.notification');

// 各店舗の予約確認表示
Route::get('/reservation_list/{id}', [ReservationListController::class, 'reservationList'])->name('reservationList');

// 決済機能
Route::post('/charge', [StripeController::class, 'charge'])->name('stripe.charge');

// QRコード表示
Route::get('/generate-qr-code', [QRCodeController::class, 'generateQRCode'])->name('QRCode');

// QRコードの店認証
Route::get('/reservations/{id}', [ReservationController::class, 'checkQRcode'])->name('checkQRcode');

