<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Models\Business;
use App\Models\User;
use App\Notifications\NewBusinessForApproval;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the user's businesses.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $businesses = $request->user()->businesses()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderByDesc('is_sponsor')
            ->orderBy('name')
            ->paginate(12);

        return view('vendor.zeus.themes.zeus.sky.private.businesses-list', compact('businesses', 'search'));
    }

    /**
     * Show the form for creating a new business.
     */
    public function create()
    {
        return view('vendor.zeus.themes.zeus.sky.private.create-business');
    }

    /**
     * Store a newly created business in storage.
     */
    public function store(StoreBusinessRequest $request)
    {
        // Check for large file uploads
        if ($request->server('CONTENT_LENGTH') > (2 * 1024 * 1024)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['logo' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
        }

        try {
            $validated = $request->validated();
        } catch (\Illuminate\Http\Exceptions\PostTooLargeException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['logo' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Check if the validation failed due to file size
            if ($request->hasFile('logo') && $request->file('logo')->getSize() > (1024 * 1024)) {
                return redirect()->back()
                    ->withInput($request->except('logo'))
                    ->withErrors(['logo' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
            }
            throw $e;
        }

        $business = new Business($validated);
        $business->user_id = $request->user()->id;
        $business->slug = Str::slug($validated['name']);
        $business->is_approved = false;
        $business->is_public = $validated['is_public'] ?? true;

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('business_logos', 'public');
            $business->photo_path = $path;
        }

        $business->save();

        // Notify admin
        $admin = User::where('is_admin', true)->first();
        if ($admin) {
            $admin->notify(new NewBusinessForApproval($business));
        }

        return redirect()->route('private.businesses.list', $business->user_id)->with('success', 'Business created successfully and sent for approval!');
    }

    /**
     * Display the specified business.
     */
    public function show(User $user, Business $business)
    {
        $this->authorize('view', $business);

        return view('vendor.zeus.themes.zeus.sky.private.view-business', compact('business'));
    }

    /**
     * Show the form for editing the specified business.
     */
    public function edit(User $user, Business $business)
    {
        $this->authorize('update', $business);

        return view('vendor.zeus.themes.zeus.sky.private.edit-business', compact('business'));
    }

    /**
     * Update the specified business in storage.
     */
    public function update(UpdateBusinessRequest $request, Business $business)
    {
        $this->authorize('update', $business);

        // Check for large file uploads
        if ($request->server('CONTENT_LENGTH') > (2 * 1024 * 1024)) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['logo' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
        }

        try {
            $validated = $request->validated();
        } catch (\Illuminate\Http\Exceptions\PostTooLargeException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['logo' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Check if the validation failed due to file size
            if ($request->hasFile('logo') && $request->file('logo')->getSize() > (1024 * 1024)) {
                return redirect()->back()
                    ->withInput($request->except('logo'))
                    ->withErrors(['logo' => 'The uploaded file is too large. Please choose an image smaller than 1MB.']);
            }
            throw $e;
        }

        // Store old logo path for deletion if new one is uploaded
        $oldLogoPath = $business->photo_path;

        $business->fill($validated);
        $business->slug = Str::slug($validated['name']);
        $business->is_public = $validated['is_public'] ?? true;

        if ($request->hasFile('logo')) {
            // Delete old logo if it exists
            if ($oldLogoPath && Storage::disk('public')->exists($oldLogoPath)) {
                Storage::disk('public')->delete($oldLogoPath);
            }

            $path = $request->file('logo')->store('business_logos', 'public');
            $business->photo_path = $path;
        }

        $business->save();

        return redirect()->route('private.businesses.list', $business->user_id)->with('success', 'Business updated successfully!');
    }

    /**
     * Remove the specified business from storage.
     */
    public function destroy(User $user, Business $business)
    {
        $this->authorize('delete', $business);

        // Delete the logo file if it exists
        if ($business->photo_path && Storage::disk('public')->exists($business->photo_path)) {
            Storage::disk('public')->delete($business->photo_path);
        }

        $business->delete();

        return redirect()->route('private.businesses.list', $business->user_id)->with('success', 'Business deleted successfully!');
    }

    /**
     * Toggle the approval status of a business.
     */
    public function toggleApproval(Business $business)
    {
        $this->authorize('approve', $business);

        $business->is_approved = ! $business->is_approved;
        $business->save();

        $status = $business->is_approved ? 'approved' : 'unapproved';

        return redirect()->back()->with('success', "Business has been {$status}!");
    }

    /**
     * Toggle the sponsor status of a business.
     */
    public function toggleSponsor(Business $business)
    {
        $this->authorize('sponsorToggle', $business);

        $business->is_sponsor = ! $business->is_sponsor;
        $business->save();

        $status = $business->is_sponsor ? 'marked as sponsor' : 'unmarked as sponsor';

        return redirect()->back()->with('success', "Business has been {$status}!");
    }

    /**
     * Toggle the public visibility of a business.
     */
    public function togglePublic(Business $business)
    {
        $this->authorize('togglePublic', $business);

        $business->is_public = ! $business->is_public;
        $business->save();

        $status = $business->is_public ? 'made public' : 'made private';

        return redirect()->back()->with('success', "Business has been {$status}!");
    }
}
