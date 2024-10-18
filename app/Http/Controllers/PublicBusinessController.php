<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use RalphJSmit\Laravel\SEO\Facades\SEOManager;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PublicBusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::approved()
            // ->with('tags')
            ->public()
            ->select('id', 'name', 'description', 'slug', 'photo_path')
            ->orderByDesc('priority')
            ->orderByDesc('is_sponsor')
            ->get();

        return Inertia::render('Businesses', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'businesses' => $businesses,
            'title' => "Entrepreneur Meet Cagliari",
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function show(string $slug)
    {
        $business = Business::approved()->public()
        ->where('slug', $slug)
        // ->with('tags')
        ->firstOrFail();

        SEOManager::SEODataTransformer(function (SEOData $SEOData) use($business) : SEOData  {
                        $eventSEOData = $business->getDynamicSEOData();
                        $SEOData->title =  $eventSEOData->title;
                        $SEOData->description =  $eventSEOData->description;
                        $SEOData->image =  $eventSEOData->image;
            return $SEOData;
        });

        return Inertia::render('Business', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'business' => $business,
            'title' => $business->title,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
