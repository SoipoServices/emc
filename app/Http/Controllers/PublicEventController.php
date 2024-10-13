<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PublicEventController extends Controller
{
    public function index()
    {
        $events = Event::approved()
            ->with('tags')
            ->select('id', 'title', 'description', 'start_date', 'end_date', 'address', 'slug', 'photo_path', 'is_member_event')
            ->orderBy('start_date', 'asc')
            ->get();

        return Inertia::render('Events', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'events' => $events,
            'title' => "Entrepreneur Meet Cagliari",
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function show(string $slug)
    {
        $event = Event::approved()->where('slug', $slug)->with('tags')->firstOrFail();

        return Inertia::render('Event', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'event' => $event,
            'title' => $event->title,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
