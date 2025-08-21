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
        
        $events = Event::approved()
            ->with(['tags','user'])
            ->select('id', 'title', 'description', 'start_date', 'end_date', 'address', 'slug', 'photo_path', 'is_member_event','user_id')
            ->orderBy('start_date', 'desc')
            ->get()
            ->groupBy('is_member_event')
            ->map(function ($groupedEvents) {
                return $groupedEvents->take(3); // Take 3 events from each group
            });

        $emcEvents = $events[false] ?? collect();
        $memberEvents = $events[true] ?? collect();

        $mainNav = \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle('main-nav');

        View::share('mainNav', $mainNav);
        View::share('emcEvents', $emcEvents);
        View::share('memberEvents', $memberEvents);
    }
}
