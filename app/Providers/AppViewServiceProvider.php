<?php

namespace App\Providers;

use App\Models\Event;
use LaraZeus\Sky\Models\Navigation;
use LaraZeus\Sky\Models\Post;
use Illuminate\Support\Facades\Log;
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

        // Share navigation across all views
        try {
            $mainNav = Navigation::where('handle', 'main-nav')->first();
            view()->share('mainNav', $mainNav);
        } catch (\Exception $e) {
            Log::error('Failed to load main navigation', ['error' => $e->getMessage()]);
            view()->share('mainNav', null);
        }

        // Share posts and stickies for Zeus Sky theme
        try {
            // Get published posts
            $posts = Post::published()->latest()->take(10)->get();
            
            // Get sticky posts (posts that are marked as sticky)
            $stickies = Post::published()->where('sticky', true)->latest()->take(3)->get();
            
            view()->share('posts', $posts);
            view()->share('stickies', $stickies);
        } catch (\Exception $e) {
            Log::error('Failed to load posts and stickies', ['error' => $e->getMessage()]);
            view()->share('posts', collect([]));
            view()->share('stickies', collect([]));
        }
        View::share('emcEvents', $emcEvents);
        View::share('memberEvents', $memberEvents);
    }
}
