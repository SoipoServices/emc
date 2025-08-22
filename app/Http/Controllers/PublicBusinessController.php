<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Facades\SEOManager;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PublicBusinessController extends Controller
{
    /**
     * Display a listing of all approved businesses.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Get sponsors separately for featured section
        $sponsors = Business::approved()
            ->public()
            ->where('is_sponsor', true)
            ->orderBy('name')
            ->get();

        // Get all businesses excluding sponsors for main listing
        $businessesQuery = Business::approved()
            ->public()
            ->where('is_sponsor', false)
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->orderBy('name');

        $businesses = $businessesQuery->paginate(12);

        return view('zeus::themes.zeus.sky.public.businesses.index', compact(
            'businesses',
            'sponsors',
            'search'
        ));
    }

    /**
     * Display the specified business.
     */
    public function show(string $slug)
    {
        $business = Business::approved()
            ->public()
            ->where('slug', $slug)
            ->firstOrFail();

        // Set up SEO data
        SEOManager::SEODataTransformer(function (SEOData $SEOData) use ($business): SEOData {
            $businessSEOData = $business->getDynamicSEOData();
            $SEOData->title = $businessSEOData->title;
            $SEOData->description = $businessSEOData->description;
            $SEOData->image = $businessSEOData->image;

            return $SEOData;
        });

        return view('vendor.zeus.themes.zeus.sky.public.businesses.show', compact('business'));
    }
}
