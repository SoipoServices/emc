<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    use AuthorizesRequests;
    const PAGINATION = 10;


    public function index(Request $request)
    {
        $search = $request->input('search');

        $businesses = Business::where('is_approved', true)
            ->when($search, function ($query) use ($search) {
                return $query->search($search);
            })
            ->orderByDesc('priority')
            ->orderByDesc('is_sponsor')
            ->paginate(self::PAGINATION);

        return view('businesses.index', compact('businesses', 'search'));
    }

    public function create()
    {
        return view('businesses.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'image' => 'required|image|max:2048',
            'telephone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable',
        ]);

        $imagePath = $request->file('image')->store('business_images', 'public');
        $validatedData['image'] = $imagePath;
        $validatedData['user_id'] = auth()->id();
        $validatedData['slug'] = Str::slug($validatedData['name']);

        Business::create($validatedData);

        return redirect()->route('businesses.index')->with('success', 'Business created successfully. It will be visible after approval.');
    }

    public function show(Business $business)
    {
        return view('businesses.show', compact('business'));
    }

    public function edit(Business $business)
    {
        $this->authorize('update', $business);
        return view('businesses.edit', compact('business'));
    }

    public function update(Request $request, Business $business)
    {
        $this->authorize('update', $business);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048',
            'telephone' => 'nullable|max:255',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($business->image);
            $imagePath = $request->file('image')->store('business_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $business->update($validatedData);

        return redirect()->route('businesses.show', $business)->with('success', 'Business updated successfully.');
    }

    public function destroy(Business $business)
    {
        $this->authorize('delete', $business);

        Storage::disk('public')->delete($business->image);
        $business->delete();

        return redirect()->route('businesses.index')->with('success', 'Business deleted successfully.');
    }
}
