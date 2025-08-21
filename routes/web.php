<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImpersonationController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\Private\BusinessController;
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

// Legal Pages
Route::view('/terms', 'legal.terms')->name('terms.show');
Route::view('/privacy', 'legal.privacy')->name('privacy.show');

Route::middleware([
    'auth:sanctum',
    'verified',
])->group(function () {
    Route::get('health', \Spatie\Health\Http\Controllers\HealthCheckResultsController::class);

    // Member Dashboard

    Route::prefix('member')->group(function () {
        // User Profile Routes
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/users/{user}', MemberController::class)->name('member');
        Route::get('/users{user}/vcard', VcardController::class)->name('member.vcard');
        // Event Routes
        Route::get('/create-event', [PrivateEventController::class, 'create'])->name('private.events.create');
        Route::post('/create-event', [PrivateEventController::class, 'store'])->name('private.events.store');
        Route::get('/{user}/events', [PrivateEventController::class, 'list'])->name('private.events.list')->middleware('user.ownership');
        Route::get('/{user}/event/{event}', [PrivateEventController::class, 'edit'])->name('private.events.edit')->middleware('user.ownership');
        Route::put('/{user}/event/{event}', [PrivateEventController::class, 'update'])->name('private.events.update')->middleware('user.ownership');

        // Business Routes
        Route::get('/{user}/hustles', [BusinessController::class, 'index'])->name('private.businesses.list')->middleware('user.ownership');
        Route::get('/{user}/hustles/create', [BusinessController::class, 'create'])->name('private.businesses.create')->middleware('user.ownership');
        Route::post('/{user}/hustles', [BusinessController::class, 'store'])->name('private.businesses.store')->middleware('user.ownership');
        Route::get('/{user}/hustles/{business}', [BusinessController::class, 'show'])->name('private.businesses.show')->middleware('user.ownership');
        Route::get('/{user}/hustles/{business}/edit', [BusinessController::class, 'edit'])->name('private.businesses.edit')->middleware('user.ownership');
        Route::put('/{user}/hustles/{business}', [BusinessController::class, 'update'])->name('private.businesses.update')->middleware('user.ownership');
        Route::delete('/{user}/hustles/{business}', [BusinessController::class, 'destroy'])->name('private.businesses.destroy')->middleware('user.ownership');

    });

});

// Impersonation routes (admin only)
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/impersonate/{user}', [ImpersonationController::class, 'start'])
        ->name('impersonate.start');
    Route::post('/impersonate/stop', [ImpersonationController::class, 'stop'])
        ->name('impersonate.stop');
});

Route::get('auth/linkedin', [LinkedinController::class, 'linkedinRedirect'])->name('linkedin.auth');
Route::get('auth/linkedin/callback', [LinkedinController::class, 'linkedinCallback'])->name('linkedin.callback');
