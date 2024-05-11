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

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reservation reminder emails to customers.';

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
        $currentDate = Carbon::now()->toDateString();
        $reservations = Reservation::whereDate('date', $currentDate)->get();

        foreach ($reservations as $reservation) {
            $shopId = $reservation->shop_id;
            $userId = Shop::where('id', $shopId)->value('user_id');
            $userEmail = User::where('id', $userId)->value('email');
            Mail::to($userEmail)->send(new ReservationReminderMail($reservation));
        }

        $this->info('successfully');
    }
}
