<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

final class TemporaryPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private string $tempPassword)
    {
    }

    public function build()
    {
        return $this->subject('Ваш временный пароль')
                    ->view('emails.temporary_password')
                    ->with(['tempPassword' => $this->tempPassword]);
    }
}
