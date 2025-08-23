<?php

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('orders announcements by scheduled_at desc', function () {
    // Use Carbon for more precise time control
    $baseTime = Carbon::parse('2025-01-01 12:00:00');

    $older = Announcement::factory()->create([
        'scheduled_at' => $baseTime->copy()->subDays(2),
    ]);

    $newer = Announcement::factory()->create([
        'scheduled_at' => $baseTime->copy()->subDay(),
    ]);

    $newest = Announcement::factory()->create([
        'scheduled_at' => $baseTime->copy(),
    ]);

    $announcements = Announcement::orderBy('scheduled_at', 'desc')->get();

    expect($announcements)->toHaveCount(3);
    expect($announcements->first()->id)->toBe($newest->id);
    expect($announcements->last()->id)->toBe($older->id);
});

it('filters scheduled announcements correctly', function () {
    $baseTime = Carbon::now();

    $past = Announcement::factory()->create([
        'scheduled_at' => $baseTime->copy()->subDay(),
    ]);

    $future = Announcement::factory()->create([
        'scheduled_at' => $baseTime->copy()->addDay(),
    ]);

    $now = Announcement::factory()->create([
        'scheduled_at' => $baseTime->copy(),
    ]);

    $scheduledAnnouncements = Announcement::scheduled()->get();

    expect($scheduledAnnouncements)->toHaveCount(2);
    expect($scheduledAnnouncements->pluck('id'))->toContain($past->id, $now->id);
    expect($scheduledAnnouncements->pluck('id'))->not->toContain($future->id);
});

it('gets latest scheduled announcement correctly', function () {
    $baseTime = Carbon::now();

    $pastOlder = Announcement::factory()->create([
        'scheduled_at' => $baseTime->copy()->subDays(2),
    ]);

    $pastNewer = Announcement::factory()->create([
        'scheduled_at' => $baseTime->copy()->subDay(),
    ]);

    $future = Announcement::factory()->create([
        'scheduled_at' => $baseTime->copy()->addDay(),
    ]);

    // Test the exact query used in AppViewServiceProvider
    $latestScheduled = Announcement::where('scheduled_at', '<=', now())
        ->orderBy('scheduled_at', 'desc')
        ->first();

    expect($latestScheduled->id)->toBe($pastNewer->id);
});
