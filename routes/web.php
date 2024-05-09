<?php

use App\Http\Controllers\LinkedinController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('health', \Spatie\Health\Http\Controllers\HealthCheckResultsController::class);
    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::put('user/profile/bio',\App\Http\Controllers\UpdateUserBioInformationController::class)->name('user-bio-information.update');
    Route::get('user/{user}/vcard',\App\Http\Controllers\VcardController::class)->name('user.vcard');
});

Route::get('auth/linkedin', [LinkedinController::class, 'linkedinRedirect'])->name('linkedin.auth');
Route::get('auth/linkedin/callback', [LinkedinController::class, 'linkedinCallback'])->name('linkedin.callback');
