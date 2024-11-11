<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkedinController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\PublicBusinessController;
use App\Http\Controllers\ReactionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserTagController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BusinessController;

Route::get('/', HomeController::class)->name('home');
Route::get('/events', [PublicEventController::class, 'index'])->name('events.index');
Route::get('/event/entrepreneurs-meet-cagliari-presents-inside-sardinias-innovation-hub', function () {
    return redirect('/event/entrepreneurs-meet-cagliari-presents-inside-one-of-sardinias-innovation-hubs');
});
Route::get('/event/{slug}', [PublicEventController::class, 'show'])->name('event.show');
Route::get('/companies', [PublicBusinessController::class, 'index'])->name('public.businesses.index');
Route::get('/company/{slug}', [PublicBusinessController::class, 'show'])->name('public.business.show');


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
    Route::put('/user/tags', [UserTagController::class, 'update'])->name('user-tags.update');
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/businesses', [BusinessController::class, 'index'])->name('businesses.index');
    Route::get('/businesses/create', [BusinessController::class, 'create'])->name('businesses.create');
    Route::post('/businesses', [BusinessController::class, 'store'])->name('businesses.store');
    Route::get('/businesses/{business}/edit', [BusinessController::class, 'edit'])->name('businesses.edit');
    Route::put('/businesses/{business}', [BusinessController::class, 'update'])->name('businesses.update');
    Route::delete('/businesses/{business}', [BusinessController::class, 'destroy'])->name('businesses.destroy');
});

Route::get('auth/linkedin', [LinkedinController::class, 'linkedinRedirect'])->name('linkedin.auth');
Route::get('auth/linkedin/callback', [LinkedinController::class, 'linkedinCallback'])->name('linkedin.callback');
