<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use RalphJSmit\Laravel\SEO\Facades\SEOManager;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PublicEventController extends Controller
{
    public function index()
    {
        $events = Event::approved()
            ->with(['tags','user']) 
            ->select('id', 'title', 'description', 'start_date', 'end_date', 'address', 'slug', 'photo_path', 'is_member_event','user_id')
            ->latest() // This orders by created_at in descending order
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
        $event = Event::approved()->where('slug', $slug)->with(['tags','user'])->firstOrFail();

        SEOManager::SEODataTransformer(function (SEOData $SEOData) use($event) : SEOData  {
                        $eventSEOData = $event->getDynamicSEOData();
                        $SEOData->title =  $eventSEOData->title;
                        $SEOData->description =  $eventSEOData->description;
                        $SEOData->image =  $eventSEOData->image;
            return $SEOData;
        });

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
