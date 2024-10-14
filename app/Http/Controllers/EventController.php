<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Notifications\NewEventForApproval;
use App\Notifications\NewEventCreated;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class EventController extends BaseController
{
    use AuthorizesRequests;
    const PAGINATION = 10;

    public function __construct()
    {
        $this->authorizeResource(Event::class, 'event', [
            'except' => ['index', 'show', 'list', 'store']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Events', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'events' => Event::approved()->with('tags')->orderBy('id','desc')->get(),
            'title' => "Entrepreneur Meet Cagliari",
            'phpVersion' => PHP_VERSION,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Events/Create', [
            'tinymceApiKey' => config('services.tinymce.api_key'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|max:1024', // Allow image upload, max 1MB
        ]);

        $event = new Event($validated);
        $event->user_id = $request->user()->id;
        $event->slug = Str::slug($validated['title']);
        $event->is_approved = false;
        $event->is_member_event = true;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('event_images', 'public');
            $event->photo_path = $path;
        }

        $event->save();

        // Notify admin
        $admin = User::where('is_admin', true)->first();
        if ($admin) {
            $admin->notify(new NewEventForApproval($event));
        }

        // Send email notification about new event
        $users = User::where('id', '!=', $request->user()->id)->get(); // Exclude the event creator
        foreach ($users as $user) {
            $user->notify(new NewEventCreated($event));
        }

        return redirect()->route('events.list')->with('flash', [
            'banner' => 'Event created successfully and sent for approval!',
            'bannerStyle' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $event = Event::approved()->where('slug',$slug)->with('tags')->orderBy('id','desc')->firstOrFail();
        return Inertia::render('Event', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'event' => $event,
            'title' => $event->title,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', [
            'event' => $event,
            'tinymceApiKey' => config('services.tinymce.api_key'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|max:1024', // Allow image upload, max 1MB
        ]);

        $event->update($validated);
        $event->slug = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->photo_path) {
                Storage::disk('public')->delete($event->photo_path);
            }
            $path = $request->file('image')->store('event_images', 'public');
            $event->photo_path = $path;
        }

        $event->save();

        return redirect()->route('events.list')->with('flash', [
            'banner' => 'Event updated successfully!',
            'bannerStyle' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('flash', [
            'banner' => 'Event deleted successfully!',
            'bannerStyle' => 'success',
        ]);
    }

    public function list()
    {
        $user = auth()->user();

        $events = Event::with(['tags', 'user'])
            ->where(function ($query) use ($user) {
                $query->where('is_approved', true)
                      ->orWhere('user_id', $user->id);
            })
            ->latest() // This orders by created_at in descending order
            ->paginate(self::PAGINATION);

        return Inertia::render('Events/List', [
            'events' => $events,
            'can' => [
                'updateEvent' => $events->mapWithKeys(function ($event) {
                    return [$event->id => $this->authorize('update', $event, false)];
                }),
            ],
        ]);
    }
}
