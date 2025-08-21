<?php

use App\Http\Controllers\Private\BusinessController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\Private\DashboardController;
use App\Http\Controllers\Private\EventController as PrivateEventController;
use App\Http\Controllers\Private\MemberController;
use App\Http\Controllers\Private\ProfileController;
use App\Http\Controllers\Private\VcardController;
use App\Http\Controllers\PublicBusinessController;
use App\Http\Controllers\PublicEventController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/events', [PublicEventController::class, 'index'])->name('public.events.index');
Route::get('/event/{slug}', [PublicEventController::class, 'show'])->name('public.event.show');
Route::get('/companies', [PublicBusinessController::class, 'index'])->name('public.businesses.index');
Route::get('/company/{slug}', [PublicBusinessController::class, 'show'])->name('public.business.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('health', \Spatie\Health\Http\Controllers\HealthCheckResultsController::class);

    // Member Dashboard

    Route::prefix("member")->group(function () {
        // User Profile Routes
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/users/{user}', MemberController::class)->name('member');
        Route::get('/users{user}/vcard', VcardController::class)->name('member.vcard');
         // Event Routes
        Route::get('/create-event', [PrivateEventController::class, 'create'])->name('private.events.create');
        Route::post('/create-event', [PrivateEventController::class, 'store'])->name('private.events.store');
        Route::get('/{user}/events', [PrivateEventController::class, 'list'])->name('private.events.list');
        Route::get('/{user}/event/{event}', [PrivateEventController::class, 'edit'])->name('private.events.edit');
        Route::put('/{user}/event/{event}', [PrivateEventController::class, 'update'])->name('private.events.update');
        
        // Business Routes
        Route::get('/{user}/hustles', [BusinessController::class, 'index'])->name('private.businesses.list');
        Route::get('/{user}/hustles/create', [BusinessController::class, 'create'])->name('private.businesses.create');
        Route::post('/{user}/hustles', [BusinessController::class, 'store'])->name('private.businesses.store');
        Route::get('/{user}/hustles/{business}', [BusinessController::class, 'show'])->name('private.businesses.show');
        Route::get('/{user}/hustles/{business}/edit', [BusinessController::class, 'edit'])->name('private.businesses.edit');
        Route::put('/{user}/hustles/{business}', [BusinessController::class, 'update'])->name('private.businesses.update');
        Route::delete('/{user}/hustles/{business}', [BusinessController::class, 'destroy'])->name('private.businesses.destroy');
        
    });


        
});

Route::get('auth/linkedin', [LinkedinController::class, 'linkedinRedirect'])->name('linkedin.auth');
Route::get('auth/linkedin/callback', [LinkedinController::class, 'linkedinCallback'])->name('linkedin.callback');
