<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $resetLink;

    public function __construct(User $user)
    {
        $this->user = $user;
        $frontendUrl = env('FRONTEND_URL', 'http://localhost:5173');
        $this->resetLink = $frontendUrl . '/reset-password?token=' . $user->reset_token;
    }

    public function build()
    {
        return $this->subject('Reset Your Password')
            ->view('emails.reset-password');
    }
}