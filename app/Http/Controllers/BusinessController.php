<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use App\Notifications\NewBusinessForApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BusinessController extends Controller
{
    use AuthorizesRequests;
    const PAGINATION = 10;


    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $query = Business::search($search)->query(fn($q) => $q->orderByDesc('priority')
                ->orderByDesc('is_sponsor'));
        } else {
            $query = Business::orderByDesc('priority')
                ->orderByDesc('is_sponsor');
        }

        $businesses = $query->paginate(self::PAGINATION);

        return Inertia::render('Businesses/Index', [
            'businesses' => $businesses,
            'search' => $search,
            'can' => [
                'createBusiness' => $businesses->mapWithKeys(function ($business) {
                    return [$business->id => $this->authorize('create', $business, false)];
                }),
                'updateBusiness' => $businesses->mapWithKeys(function ($business) {
                    return [$business->id => $this->authorize('update', $business, false)];
                }),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Businesses/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'image' => 'required|image|max:2048', // Allow image upload, max 2MB
            'telephone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable',
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['slug'] = Str::slug($validatedData['name']);

        $business = new Business($validatedData);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('business_images', 'public');
            $business->photo_path = $path;
        }
        $business->save();

        $admin = User::where('is_admin', true)->first();
        if ($admin) {
            $admin->notify(new NewBusinessForApproval($business));
        }

        return redirect()->route('businesses.index')->with('success', 'Business created successfully. It will be visible after approval.');
    }

    public function show(Business $business)
    {
        return Inertia::render('Events/Show', compact('business'));
    }

    public function edit(Business $business)
    {
        $this->authorize('update', $business);
        return Inertia::render('Businesses/Edit', [
            'business' => $business,
        ]);
    }

    public function update(Request $request, Business $business)
    {
        $this->authorize('update', $business);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048', // Allow image upload, max 2MB
            'telephone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($business->photo_path) {
                Storage::disk('public')->delete($business->photo_path);
            }
            $path = $request->file('image')->store('business_images', 'public');
            $business->photo_path = $path;
        }


        $business->update($validatedData);

        return redirect()->route('businesses.index')->with('success', 'Business updated successfully.');
    }

    public function destroy(Business $business)
    {
        $this->authorize('delete', $business);

        Storage::disk('public')->delete($business->photo_path);
        $business->delete();

        return redirect()->route('businesses.index')->with('success', 'Business deleted successfully.');
    }
}
