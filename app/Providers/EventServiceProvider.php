<?php

namespace App\Providers;

// use App\Listeners\Auth\RegisterListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Auth\RegisterEvent' => [
            'App\Listeners\Auth\RegisterListener',
        ],
    ];

    // protected $subscribe = [
    //     RegisterListener::class,
    // ];
}
