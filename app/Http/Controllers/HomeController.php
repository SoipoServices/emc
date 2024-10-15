<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response|RedirectResponse
    {
        $events = Event::approved()
            ->with('tags')
            ->select('id', 'title', 'description', 'start_date', 'end_date', 'address', 'slug', 'photo_path', 'is_member_event')
            ->orderBy('start_date', 'desc')
            ->get()
            ->groupBy('is_member_event')
            ->map(function ($groupedEvents) {
                return $groupedEvents->take(3); // Changed from 2 to 3
            });

        $emcEvents = $events[false] ?? collect();
        $memberEvents = $events[true] ?? collect();

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'applicationName' => config('app.name'),
            'emcEvents' => $emcEvents,
            'memberEvents' => $memberEvents,
        ]);
    }
}
