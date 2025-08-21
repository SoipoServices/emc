<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Notifications\NewEventCreated;
use App\Notifications\NewEventForApproval;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of all events separated by member and non-member events.
     */
    public function list(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();

        // Base query for events user can see
        $baseQuery = Event::with(['user', 'tags'])
            ->where(function ($query) use ($user) {
                $query->where('is_approved', true)
                    ->orWhere('user_id', $user->id); // Users can see their own events even if not approved
            })
            ->orderBy('start_date', 'asc');

        // Apply search if provided
        if ($search) {
            $baseQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Get all events combined and paginated
        $allEvents = $baseQuery->paginate(4);

        return view('vendor.zeus.themes.zeus.sky.private.events-list', compact(
            'allEvents',
            'search'
        ));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('vendor.zeus.themes.zeus.sky.private.create-event');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        // Check for request size before validation
        if ($request->server('CONTENT_LENGTH') > (2 * 1024 * 1024)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['image' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'address' => 'required|string|max:255',
                'link' => 'nullable|url|max:255',
                'image' => 'nullable|image|max:1024', // Allow image upload, max 1MB
            ]);
        } catch (\Illuminate\Http\Exceptions\PostTooLargeException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['image' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Check if the validation failed due to file size
            if ($request->hasFile('image') && $request->file('image')->getSize() > (1024 * 1024)) {
                return redirect()->back()
                    ->withInput($request->except('image'))
                    ->withErrors(['image' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
            }
            throw $e;
        }

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

        return redirect()->route('private.events.list', ['user' => $request->user()->id])->with('success', 'Event created successfully and sent for approval!');
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        return view('vendor.zeus.themes.zeus.sky.private.edit-event', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        // Check for request size before validation
        if ($request->server('CONTENT_LENGTH') > (2 * 1024 * 1024)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['image' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'address' => 'required|string|max:255',
                'link' => 'nullable|url|max:255',
                'image' => 'nullable|image|max:1024', // Allow image upload, max 1MB
            ]);
        } catch (\Illuminate\Http\Exceptions\PostTooLargeException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['image' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Check if the validation failed due to file size
            if ($request->hasFile('image') && $request->file('image')->getSize() > (1024 * 1024)) {
                return redirect()->back()
                    ->withInput($request->except('image'))
                    ->withErrors(['image' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
            }
            throw $e;
        }

        $event->fill($validated);
        $event->slug = Str::slug($validated['title']);

        // Reset approval status when event is updated
        $event->is_approved = false;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->photo_path) {
                Storage::disk('public')->delete($event->photo_path);
            }
            $path = $request->file('image')->store('event_images', 'public');
            $event->photo_path = $path;
        }

        $event->save();

        // Notify admin about the updated event
        $admin = User::where('is_admin', true)->first();
        if ($admin) {
            $admin->notify(new NewEventForApproval($event));
        }

        return redirect()->route('private.events.list', ['user' => $request->user()->id])->with('success', 'Event updated successfully and sent for approval!');
    }
}
