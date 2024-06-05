<?php

namespace App\Providers;

use App\Checks\MailCheck;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
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

        Gate::define('viewPulse', function (User $user) {
            return $user->is_admin;
        });
    }
}
