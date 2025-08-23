<?php

namespace App\Providers;

use App\Models\Event;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        
        // Only execute database queries if we can connect and tables exist
        try {
            // Check if we can access the database
            DB::connection()->getPdo();

            // Get all upcoming approved events
            $upcomingEvents = Event::where('start_date', '>', now())
                ->approved()
                ->orderBy('start_date', 'asc')
                ->get();

            // Share latest event globally with all views
            $latestEvent = $upcomingEvents->first();

            $events = Event::approved()
                ->with(['tags', 'user'])
                ->select('id', 'title', 'description', 'start_date', 'end_date', 'address', 'slug', 'photo_path', 'is_member_event', 'user_id')
                ->orderBy('start_date', 'desc')
                ->get()
                ->groupBy('is_member_event')
                ->map(function ($groupedEvents) {
                    return $groupedEvents->take(3); // Take 3 events from each group
                });

            $emcEvents = $events[false] ?? collect();
            $memberEvents = $events[true] ?? collect();

        } catch (\Exception $e) {
            // If database queries fail, set default values
            Log::error('Failed to load events: '.$e->getMessage());
            $latestEvent = null;
            $emcEvents = collect();
            $memberEvents = collect();
        }

        try {
            $mainNav = \LaraZeus\Sky\SkyPlugin::get()->getModel('Navigation')::fromHandle('main');
        } catch (\Exception $e) {
            // If navigation fails, set to null
            $mainNav = null;
            Log::error('Failed to load main navigation: '.$e->getMessage());
        }

        View::share('latestEvent', $latestEvent);
        View::share('mainNav', $mainNav);
        View::share('emcEvents', $emcEvents);
        View::share('memberEvents', $memberEvents);
        
        
        View::share('theme',  config('emc.theme'));
         $this->app->singleton('theme', function () {
            return config('emc.theme');
        });

        // Override Zeus Sky theme to use our EMC theme
        View::share('skyTheme',  config('emc.theme'));
        $this->app->singleton('skyTheme', function () {
            return config('emc.theme');
        });
       
        //transform 'themes.emc' int themes/emc
        $themePath = Str::of(config('emc.theme'))->replace('.', '/')->__toString();

         // Register theme namespace for cleaner component syntax
        View::addNamespace('theme', resource_path("/views/".$themePath));
        // Configure pagination to use Tailwind view
        Paginator::defaultView('theme::pagination.tailwind');
        Paginator::defaultSimpleView('theme::pagination.simple-tailwind');


    }
}
