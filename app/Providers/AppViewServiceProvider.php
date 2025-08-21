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
        // Get all upcoming approved events
        $upcomingEvents = Event::where('start_date', '>', now())
            ->approved()
            ->orderBy('start_date', 'asc')
            ->get();
            
        // Share latest event globally with all views
        $latestEvent = $upcomingEvents->first();
        View::share('latestEvent', $latestEvent);
        
        // Share events collection for Zeus Sky template
        $emcEvents = $upcomingEvents->where('is_member_event', false);
        $memberEvents = $upcomingEvents->where('is_member_event', true);
        
        View::share('emcEvents', $emcEvents);
        View::share('memberEvents', $memberEvents);
    }
}
