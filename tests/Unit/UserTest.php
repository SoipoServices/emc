<?php

use App\Models\User;
use App\Models\Business;
use App\Models\Event;
use Filament\Panel;

beforeEach(function () {
    $this->user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'is_admin' => false,
        'is_visible' => true,
        'is_disabled' => false,
        'telephone' => '+1234567890',
        'position' => 'Developer',
        'city' => 'Test City',
        'country' => 'Test Country',
        'bio' => 'This is a test bio for the user.',
    ]);
});

describe('User Model', function () {
    it('can be created with valid attributes', function () {
        expect($this->user)->toBeInstanceOf(User::class)
            ->and($this->user->name)->toBe('John Doe')
            ->and($this->user->email)->toBe('john@example.com')
            ->and($this->user->is_admin)->toBeFalse()
            ->and($this->user->is_visible)->toBeTrue();
    });

    it('can determine if user has bio', function () {
        expect($this->user->has_bio)->toBeTrue();

        $userWithoutBio = User::factory()->create(['bio' => null]);
        expect($userWithoutBio->has_bio)->toBeFalse();
    });

    it('can determine if user is verified', function () {
        $verifiedUser = User::factory()->create(['email_verified_at' => now()]);
        expect($verifiedUser->is_verified)->toBeTrue();

        $unverifiedUser = User::factory()->create(['email_verified_at' => null]);
        expect($unverifiedUser->is_verified)->toBeFalse();
    });

    it('can scope verified users', function () {
        User::factory()->create(['email_verified_at' => now()]);
        User::factory()->create(['email_verified_at' => null]);

        $verifiedUsers = User::verified()->get();
        expect($verifiedUsers)->toHaveCount(2); // Including the beforeEach user
    });

    it('can scope users with bio', function () {
        User::factory()->create(['bio' => 'Another bio']);
        User::factory()->create(['bio' => null]);

        $usersWithBio = User::hasBio()->get();
        expect($usersWithBio)->toHaveCount(2); // Including the beforeEach user
    });

    it('can scope users with position', function () {
        User::factory()->create(['position' => 'Manager']);
        User::factory()->create(['position' => null]);

        $usersWithPosition = User::hasPosition()->get();
        expect($usersWithPosition)->toHaveCount(2); // Including the beforeEach user
    });

    it('can scope visible users', function () {
        User::factory()->create(['is_visible' => true]);
        User::factory()->create(['is_visible' => false]);

        $visibleUsers = User::isVisible()->get();
        expect($visibleUsers)->toHaveCount(2); // Including the beforeEach user
    });

    it('has searchable array configured correctly', function () {
        $searchableArray = $this->user->toSearchableArray();

        expect($searchableArray)->toHaveKeys([
            'id', 'name', 'email', 'position', 'city', 'country', 'bio'
        ]);
    });

    it('can access Filament admin panel when is_admin is true', function () {
        $admin = User::factory()->create(['is_admin' => true, 'email_verified_at' => now()]);
        $panel = \Mockery::mock(\Filament\Panel::class);
        
        expect($admin->canAccessPanel($panel))->toBeTrue();
        expect($this->user->canAccessPanel($panel))->toBeFalse();
    });

    it('can check impersonation permissions', function () {
        $admin = User::factory()->create(['is_admin' => true]);
        
        expect($admin->canImpersonate())->toBeTrue();
        expect($this->user->canBeImpersonated())->toBeTrue();
        expect($this->user->canImpersonate())->toBeFalse();
    });
});

describe('User Relationships', function () {
    it('has many businesses', function () {
        $businesses = Business::factory()->count(2)->create(['user_id' => $this->user->id]);

        expect($this->user->businesses)->toHaveCount(2)
            ->and($this->user->businesses->first())->toBeInstanceOf(Business::class);
    });

    it('has many events', function () {
        $events = Event::factory()->count(3)->create(['user_id' => $this->user->id]);

        expect($this->user->events)->toHaveCount(3)
            ->and($this->user->events->first())->toBeInstanceOf(Event::class);
    });

    it('can have saved library items', function () {
        // Skip this test for now as Library factory doesn't exist
        expect(true)->toBeTrue();
    })->skip('Library factory not implemented yet');
});

describe('User Attributes', function () {
    it('hides sensitive attributes from array', function () {
        $userArray = $this->user->toArray();

        expect($userArray)->not->toHaveKey('password')
            ->and($userArray)->not->toHaveKey('remember_token')
            ->and($userArray)->not->toHaveKey('two_factor_recovery_codes')
            ->and($userArray)->not->toHaveKey('two_factor_secret');
    });

    it('includes appended attributes in array', function () {
        $userArray = $this->user->toArray();

        expect($userArray)->toHaveKey('profile_photo_url')
            ->and($userArray)->toHaveKey('has_bio')
            ->and($userArray)->toHaveKey('is_verified');
    });

    it('casts attributes correctly', function () {
        expect($this->user->is_admin)->toBeBool()
            ->and($this->user->is_visible)->toBeBool()
            ->and($this->user->is_disabled)->toBeBool();
    });
});
