<?php

namespace App\Http\Controllers;

use App\Models\Event;
use RalphJSmit\Laravel\SEO\Facades\SEOManager;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class EventController extends Controller
{
    public function index()
    {
        // Get all approved events with pagination
        $events = Event::approved()
            ->with(['tags', 'user'])
            ->select('id', 'title', 'description', 'start_date', 'end_date', 'address', 'slug', 'photo_path', 'is_member_event', 'user_id')
            ->orderBy('start_date', 'asc')
            ->paginate(12);

        // Separate events by type for display
        $officialEvents = $events->where('is_member_event', false);
        $memberEvents = $events->where('is_member_event', true);

        return view('theme::events.index', compact(
            'events',
            'officialEvents',
            'memberEvents'
        ));
    }

    public function show(string $slug)
    {
        $event = Event::approved()->where('slug', $slug)->with(['tags', 'user'])->firstOrFail();

        SEOManager::SEODataTransformer(function (SEOData $SEOData) use ($event): SEOData {
            $eventSEOData = $event->getDynamicSEOData();
            $SEOData->title = $eventSEOData->title;
            $SEOData->description = $eventSEOData->description;
            $SEOData->image = $eventSEOData->image;

            return $SEOData;
        });

        return view('theme::events.show', compact('event'));
    }
}
