<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function sendNotification(Request $request)
    {
        $email = $request->input('email');
        $subject = $request->input('subject');
        $content = $request->input('content');

        $userEmail = $request->input('userEmail');


        $data = [
            'email' => $email,
            'subject' => $subject,
            'content' => $content
        ];


        Mail::to($userEmail)->send(new NotificationMail($data));
        return redirect()->back()->with('success', 'メール送信が完了しました。');
    }
}
