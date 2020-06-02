<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $token;
    protected $randomPassword;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $token
     */
    public function __construct($user, $token, $randomPassword)
    {
        //
        $this->user = $user;
        $this->token = $token;
        $this->randomPassword = $randomPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.forgotPassword')->with([
            'user' => $this->user,
            'token' => $this->token,
            'password' => $this->randomPassword
        ]);
    }
}
