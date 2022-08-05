<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dusterio\LumenPassport\LumenPassport;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        LumenPassport::routes($this->app->router, [
            'prefix' => 'v1/oauth',
        ]);

        LumenPassport::tokensExpireIn(Carbon::now()->addDay());
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(2));

        $this->app->make('queue');
    }
}
