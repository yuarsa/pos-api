<?php

namespace App\Mails\Auth;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    protected $company;

    public function __construct($user, $company)
    {
        $this->user = $user;

        $this->company = $company;
    }

    public function build()
    {
       
        $user = $this->user;

        $company = $this->company;

        return $this->view('emails.registration_company', compact('user', 'company'));
    }
}
