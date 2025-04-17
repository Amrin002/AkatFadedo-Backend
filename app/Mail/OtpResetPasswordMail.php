<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $link;

    public function __construct(string $otp, string $link)
    {
        $this->otp = $otp;
        $this->link = $link;
    }

    public function build()
    {
        return $this->subject('Reset Password - Local Class Tech')
            ->markdown('emails.otp');
    }
}
