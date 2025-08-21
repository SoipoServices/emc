<?php

use App\Http\Controllers\LinkPreviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/link-preview', [LinkPreviewController::class, 'preview']);
