<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReminderMail;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;
use Carbon\Carbon;


class SendReservationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservation-reminder:send';
    // コマンドで使用

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation reminder emails to customers.';
    // 説明の文章を記述

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // 現在の日時の取得
        $currentDate = Carbon::now()->toDateString();
        // 予約から予約日と当日の日にちが一致するレコードの取得
        $reservations = Reservation::whereDate('date', $currentDate)->get();

        // メール送信機能の定義
        foreach ($reservations as $reservation) {
            // 予約から予約日と当日の日にちが一致するshop_idの取得
            $shopId = $reservation->shop_id;
            // 上記の条件のShopモデルのuser_idを取得
            $userId = Shop::where('id', $shopId)->value('user_id');
            // 上記の条件のUserモデルのemailを取得
            $userEmail = User::where('id', $userId)->value('email');

            // メール送信
            Mail::to($userEmail)->send(new ReservationReminderMail($reservation));
        }

        // メッセージを出力する。
        $this->info('successfully');
    }
}
