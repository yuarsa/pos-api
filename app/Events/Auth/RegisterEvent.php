<?php

namespace App\Events\Auth;

use App\Events\Event;

class RegisterEvent extends Event
{
    public function __construct($user, $company)
    {
        $this->user = $user;
        
        $this->company = $company;
        
    }
}