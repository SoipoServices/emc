<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
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

        return view('vendor.zeus.themes.zeus.sky.home', [
            'skyTheme' => 'vendor.zeus.themes.zeus.sky',
            'emcEvents' => $emcEvents,
            'memberEvents' => $memberEvents,
        ]);
    }
}
