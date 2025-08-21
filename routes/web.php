<?php

use App\Http\Controllers\BusinessController;
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
        Route::get('/events', [PrivateEventController::class, 'list'])->name('private.events.list');
        Route::get('/event/{event}', [PrivateEventController::class, 'edit'])->name('private.events.edit');
        Route::put('/event/{event}', [PrivateEventController::class, 'update'])->name('private.events.update');

    });


    // Business Routes
    Route::get('/businesses', [BusinessController::class, 'index'])->name('businesses.index');
    Route::get('/businesses/create', [BusinessController::class, 'create'])->name('businesses.create');
    Route::post('/businesses', [BusinessController::class, 'store'])->name('businesses.store');
    Route::get('/businesses/{business}/edit', [BusinessController::class, 'edit'])->name('businesses.edit');
    Route::put('/businesses/{business}', [BusinessController::class, 'update'])->name('businesses.update');
    Route::delete('/businesses/{business}', [BusinessController::class, 'destroy'])->name('businesses.destroy');
});

Route::get('auth/linkedin', [LinkedinController::class, 'linkedinRedirect'])->name('linkedin.auth');
Route::get('auth/linkedin/callback', [LinkedinController::class, 'linkedinCallback'])->name('linkedin.callback');
