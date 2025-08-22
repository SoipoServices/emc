<?php

use App\Models\User;
use App\Models\Business;
use App\Models\Event;

beforeEach(function () {
    // No storage setup needed for these basic tests
});

describe('HasPhoto Trait', function () {
    it('is used by User model', function () {
        $user = User::factory()->create();
        expect(in_array(\App\Traits\HasPhoto::class, class_uses($user)))->toBeTrue();
    });

    it('is used by Business model', function () {
        $business = Business::factory()->create();
        expect(in_array(\App\Traits\HasPhoto::class, class_uses($business)))->toBeTrue();
    });

    it('is used by Event model', function () {
        $event = Event::factory()->create();
        expect(in_array(\App\Traits\HasPhoto::class, class_uses($event)))->toBeTrue();
    });
});

describe('Business Photo URL', function () {
    it('returns empty string when no photo path is set', function () {
        $business = Business::factory()->create(['photo_path' => null]);
        expect($business->photo_url)->toBe('');
    });

    it('returns storage URL when photo path is set', function () {
        $business = Business::factory()->create(['photo_path' => 'business-photos/business-123.jpg']);
        expect($business->photo_url)->toContain('business-photos/business-123.jpg');
    });
});

describe('Event Photo URL', function () {
    it('returns null when no photo path is set', function () {
        $event = Event::factory()->create(['photo_path' => null]);
        expect($event->photo_url)->toBeNull();
    });

    it('returns storage URL when photo path is set', function () {
        $event = Event::factory()->create(['photo_path' => 'event-photos/event-123.jpg']);
        expect($event->photo_url)->toContain('event-photos/event-123.jpg');
    });
});

describe('User Profile Photo URL', function () {
    it('returns default avatar URL when no photo path is set', function () {
        $user = User::factory()->create(['profile_photo_path' => null]);
        expect($user->profile_photo_url)->toContain('ui-avatars.com/api/');
    });

    it('returns storage URL when photo path is set', function () {
        $user = User::factory()->create(['profile_photo_path' => 'photos/user-123.jpg']);
        expect($user->profile_photo_url)->toContain('photos/user-123.jpg');
    });
});

describe('Photo URLs in Array Representation', function () {
    it('includes profile_photo_url in User array representation', function () {
        $user = User::factory()->create();
        $userArray = $user->toArray();
        
        expect($userArray)->toHaveKey('profile_photo_url');
    });

    it('includes photo_url in Business array representation', function () {
        $business = Business::factory()->create();
        $businessArray = $business->toArray();
        
        expect($businessArray)->toHaveKey('photo_url');
    });

    it('includes photo_url in Event array representation', function () {
        $event = Event::factory()->create();
        $eventArray = $event->toArray();
        
        expect($eventArray)->toHaveKey('photo_url');
    });
});
