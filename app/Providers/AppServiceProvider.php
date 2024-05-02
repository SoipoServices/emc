<?php

namespace App\Providers;

use App\Checks\MailCheck;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Facades\Health;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Health::checks([
            MailCheck::new(),
            DatabaseCheck::new(),
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if (App::environment('production')) {
        //     URL::forceScheme('https');
        // }
    }
}
