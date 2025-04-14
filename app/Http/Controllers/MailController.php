<?php

namespace App\Http\Controllers;

use App\Mail\SendWelcomeMail;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendMail()
    {
        // dd(config('mail.mailers.smtp'));

        try {
            $toEmailAddress = "amrinlatuconsina@gmail.com";
            $welcomeMessage = "Ini adalah email dari mailtrap configuration";
            $response = Mail::to($toEmailAddress)->send(new SendWelcomeMail($welcomeMessage));
            dd($response);
        } catch (\Exception $e) {
            Log::error("Unable to Send email" . $e->getMessage());
        }
    }
}
