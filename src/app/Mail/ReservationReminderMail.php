<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ReservationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $reservation; // $reservationプロパティを定義

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $userName = $this->reservation->user->name;

        return $this->view('mail.reservationReminder')
        ->subject('予約当日のお知らせ')
        ->with([
                'name' => $userName,
                'date' => $this->reservation->date,
        ]);
    }
}
