<?php

namespace App\Http\Controllers;

use App\Models\Event;
use RalphJSmit\Laravel\SEO\Facades\SEOManager;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PublicEventController extends Controller
{
    public function index()
    {
        // Get approved events separated by type
        $officialEvents = Event::approved()
            ->with(['tags', 'user'])
            ->where('is_member_event', false)
            ->select('id', 'title', 'description', 'start_date', 'end_date', 'address', 'slug', 'photo_path', 'is_member_event', 'user_id')
            ->orderBy('start_date', 'asc')
            ->get();

        $memberEvents = Event::approved()
            ->with(['tags', 'user'])
            ->where('is_member_event', true)
            ->select('id', 'title', 'description', 'start_date', 'end_date', 'address', 'slug', 'photo_path', 'is_member_event', 'user_id')
            ->orderBy('start_date', 'asc')
            ->get();

        return view('vendor.zeus.themes.zeus.sky.public.events.index', compact(
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

        return view('vendor.zeus.themes.zeus.sky.public.events.show', compact('event'));
    }
}
