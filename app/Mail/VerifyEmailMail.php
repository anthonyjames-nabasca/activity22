<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $verifyLink;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->verifyLink = url('/api/verify-email?token=' . $user->verification_token);
    }

    public function build()
    {
        return $this->subject('Verify Your Email Address')
            ->view('emails.verify-email');
    }
}