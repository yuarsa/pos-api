<?php

namespace App\Listeners\Auth;

use App\Events\Auth\RegisterEvent;
use App\Mails\Auth\RegisterMail;
use Illuminate\Support\Facades\Mail;

class RegisterListener
{
    public function __construct()
    {

    }

    public function handle(RegisterEvent $event)
    {
        $user = $event->user;

        $company = $event->company;
        return Mail::to($company->comp_email)->send(new RegisterMail($user, $company));

    }

    // public function onSendRegisterEmailConfirm($event)
    // {
    //     $user = $event->user;

    //     $company = $event->company;

    //     Mail::to($company->comp_email)->send(new RegisterMail($user, $company));
    // }

    // public function subscribe($events)
    // {
    //     $events->listen(
    //         RegisterEvent::class,
    //         'App\Listener\Auth\RegisterListener@onSendRegisterEmailConfirm'
    //     );
    // }
}
