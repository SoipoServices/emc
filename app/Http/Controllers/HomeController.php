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
    public function __invoke(Request $request):Response|RedirectResponse
    {
        $events = Event::approved()
            ->with('tags')
            ->select('id', 'title', 'description', 'start_date', 'end_date', 'address', 'slug', 'photo_path', 'is_member_event')
            ->orderBy('start_date', 'desc')
            ->get();

        $emcEvents = $events->where('is_member_event', false);
        $memberEvents = $events->where('is_member_event', true);

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'events' => $emcEvents,
            'memberEvents' => $memberEvents,
            'title' => "Entrepreneur Meet Cagliari",
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
