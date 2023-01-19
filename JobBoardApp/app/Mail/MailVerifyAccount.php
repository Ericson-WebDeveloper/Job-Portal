<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailVerifyAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public $token;
    public $link;
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
        $this->link = "http://localhost:3000/verify-account/{$user->email}/{$token}";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.verify-account');
    }
}
