<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): PasswordResetLinkMail
    {
        return $this->markdown('mails.reset-password-link')
            ->with([
                'user'  => $this->user,
                'token' => $this->token,
            ]);
    }
}
