<?php

namespace App\Providers;

use App\Models\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share latest event globally with all views
        $latestEvent = Event::where('start_date', '>', now())
            ->approved()
            ->orderBy('start_date', 'asc')
            ->first();
            
        View::share('latestEvent', $latestEvent);
    }
}
