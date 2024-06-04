<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkedinController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', HomeController::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('health', \Spatie\Health\Http\Controllers\HealthCheckResultsController::class);
    Route::match(['get', 'post'],'/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::put('user/profile/bio',\App\Http\Controllers\UpdateUserBioInformationController::class)->name('user-bio-information.update');
    Route::get('user/{user}/vcard',\App\Http\Controllers\VcardController::class)->name('user.vcard');
});

Route::get('auth/linkedin', [LinkedinController::class, 'linkedinRedirect'])->name('linkedin.auth');
Route::get('auth/linkedin/callback', [LinkedinController::class, 'linkedinCallback'])->name('linkedin.callback');
