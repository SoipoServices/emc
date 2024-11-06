<?php

namespace App\Providers;

use App\Models\Event;
use App\Policies\EventPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Auth\TaggableUserProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Business;
use App\Policies\BusinessPolicy;

class AuthServiceProvider extends ServiceProvider
{
    // protected $policies = [
    //     Event::class => EventPolicy::class,
    //     Business::class => BusinessPolicy::class,
    // ];

    public function boot(): void
    {
        $this->registerPolicies();

        Auth::provider('taggable', function ($app, array $config) {
            return new TaggableUserProvider($app['hash'], $config['model']);
        });

        // ... (any other Gate definitions)
    }
}
