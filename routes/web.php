<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\ReactionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', HomeController::class)->name('home');
Route::get('/events', [PublicEventController::class, 'index'])->name('events.index');
Route::get('/event/{slug}', [PublicEventController::class, 'show'])->name('event.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('health', \Spatie\Health\Http\Controllers\HealthCheckResultsController::class);
    Route::match(['get', 'post'],'/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::put('user/profile/bio',\App\Http\Controllers\UpdateUserBioInformationController::class)->name('user-bio-information.update');
    Route::get('user/{user}/vcard',\App\Http\Controllers\VcardController::class)->name('user.vcard');
    Route::get('/billboard', [PostController::class, 'index'])->name('billboard.index');
    Route::get('/billboard/create', [PostController::class, 'create'])->name('billboard.create');
    Route::get('/billboard/{post}', [PostController::class, 'show'])->name('billboard.show');
    Route::post('/billboard', [PostController::class, 'store'])->name('billboard.store');
    Route::put('/billboard/{post}', [PostController::class, 'update'])->name('billboard.update');
    Route::delete('/billboard/{post}', [PostController::class, 'destroy'])->name('billboard.destroy');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/react', [ReactionController::class, 'toggle'])->name('posts.react');
    Route::get('/events/list', [EventController::class, 'list'])->name('events.list');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/billboard/{post}/edit', [PostController::class, 'edit'])->name('billboard.edit');
});

Route::get('auth/linkedin', [LinkedinController::class, 'linkedinRedirect'])->name('linkedin.auth');
Route::get('auth/linkedin/callback', [LinkedinController::class, 'linkedinCallback'])->name('linkedin.callback');
