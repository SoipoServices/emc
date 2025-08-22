<?php

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->event = Event::factory()->create([
        'title' => 'Test Event',
        'slug' => 'test-event',
        'description' => 'This is a test event description.',
        'address' => '123 Test Street, Test City',
        'start_date' => '2025-09-01 10:00:00',
        'end_date' => '2025-09-01 12:00:00',
        'is_approved' => true,
        'is_member_event' => false,
        'user_id' => $this->user->id,
        'link' => 'https://example.com/event',
    ]);
});

describe('Event Model', function () {
    it('can be created with valid attributes', function () {
        expect($this->event)->toBeInstanceOf(Event::class)
            ->and($this->event->title)->toBe('Test Event')
            ->and($this->event->slug)->toBe('test-event')
            ->and($this->event->description)->toBe('This is a test event description.')
            ->and($this->event->address)->toBe('123 Test Street, Test City')
            ->and($this->event->is_approved)->toBeTrue()
            ->and($this->event->is_member_event)->toBeFalse()
            ->and($this->event->link)->toBe('https://example.com/event');
    });

    it('has correct fillable attributes', function () {
        $fillable = $this->event->getFillable();
        
        expect($fillable)->toContain('title', 'slug', 'description', 'address')
            ->and($fillable)->toContain('start_date', 'end_date', 'is_approved', 'is_member_event')
            ->and($fillable)->toContain('user_id', 'photo_path', 'link');
    });

    it('casts date attributes correctly', function () {
        expect($this->event->start_date)->toBeInstanceOf(Carbon::class)
            ->and($this->event->end_date)->toBeInstanceOf(Carbon::class);
    });

    it('casts boolean attributes correctly', function () {
        expect($this->event->is_approved)->toBeBool()
            ->and($this->event->is_member_event)->toBeBool();
    });

    it('appends photo_url to array', function () {
        $eventArray = $this->event->toArray();
        
        expect($eventArray)->toHaveKey('photo_url');
    });

    it('has searchable array configured correctly', function () {
        $searchableArray = $this->event->toSearchableArray();
        
        expect($searchableArray)->toHaveKeys([
            'id', 'title', 'slug', 'address', 'start_date', 'end_date'
        ]);
    });
});

describe('Event Scopes', function () {
    it('can scope approved events', function () {
        Event::factory()->create(['is_approved' => false]);
        Event::factory()->create(['is_approved' => true]);
        
        $approvedEvents = Event::approved()->get();
        expect($approvedEvents)->toHaveCount(2); // Including the beforeEach event
    });

    it('can scope member events', function () {
        Event::factory()->create(['is_member_event' => true]);
        Event::factory()->create(['is_member_event' => false]);
        
        $memberEvents = Event::memberEvent()->get();
        expect($memberEvents)->toHaveCount(1);
    });
});

describe('Event Relationships', function () {
    it('belongs to a user', function () {
        expect($this->event->user)->toBeInstanceOf(User::class)
            ->and($this->event->user->id)->toBe($this->user->id);
    });

    it('can be created with user relationship', function () {
        $newUser = User::factory()->create();
        $newEvent = Event::factory()->create(['user_id' => $newUser->id]);
        
        expect($newEvent->user->id)->toBe($newUser->id);
    });
});

describe('Event SEO and Sitemap', function () {
    it('implements Sitemapable interface', function () {
        expect($this->event)->toBeInstanceOf(\Spatie\Sitemap\Contracts\Sitemapable::class);
    });

    it('generates dynamic SEO data', function () {
        $seoData = $this->event->getDynamicSEOData();
        
        expect($seoData)->toBeInstanceOf(\RalphJSmit\Laravel\SEO\Support\SEOData::class);
    });

    it('generates sitemap tag', function () {
        $sitemapTag = $this->event->toSitemapTag();
        
        expect($sitemapTag)->toBeString()
            ->and($sitemapTag)->toContain($this->event->slug);
    });
});

describe('Event Photo Management', function () {
    it('uses HasPhoto trait', function () {
        expect(in_array(\App\Traits\HasPhoto::class, class_uses($this->event)))->toBeTrue();
    });

    it('has photo_url accessor', function () {
        // Test with no photo
        expect($this->event->photo_url)->toBeNull();
        
        // Test with photo path
        $eventWithPhoto = Event::factory()->create(['photo_path' => 'test-event-photo.jpg']);
        expect($eventWithPhoto->photo_url)->toContain('test-event-photo.jpg');
    });
});

describe('Event Tags', function () {
    it('uses HasTags trait', function () {
        expect(in_array(\Spatie\Tags\HasTags::class, class_uses($this->event)))->toBeTrue();
    });

    it('can attach tags to event', function () {
        $this->event->attachTag('conference');
        $this->event->attachTag('networking');
        
        expect($this->event->tags)->toHaveCount(2);
    });

    it('can find events by tag', function () {
        $this->event->attachTag('workshop');
        $anotherEvent = Event::factory()->create();
        $anotherEvent->attachTag('conference');
        
        $workshopEvents = Event::withAnyTags(['workshop'])->get();
        expect($workshopEvents)->toHaveCount(1)
            ->and($workshopEvents->first()->id)->toBe($this->event->id);
    });
});

describe('Event Date Validation', function () {
    it('can handle same day events', function () {
        $sameDayEvent = Event::factory()->create([
            'start_date' => '2025-09-01 09:00:00',
            'end_date' => '2025-09-01 17:00:00',
        ]);
        
        expect($sameDayEvent->start_date->format('Y-m-d'))
            ->toBe($sameDayEvent->end_date->format('Y-m-d'));
    });

    it('can handle multi-day events', function () {
        $multiDayEvent = Event::factory()->create([
            'start_date' => '2025-09-01 09:00:00',
            'end_date' => '2025-09-03 17:00:00',
        ]);
        
        expect($multiDayEvent->start_date->format('Y-m-d'))
            ->not->toBe($multiDayEvent->end_date->format('Y-m-d'));
    });

    it('handles timezone correctly', function () {
        $event = Event::factory()->create([
            'start_date' => '2025-09-01 10:00:00',
        ]);
        
        expect($event->start_date->timezone->getName())->toBe(config('app.timezone'));
    });
});

describe('Event Factory', function () {
    it('can create event with factory', function () {
        $event = Event::factory()->create();
        
        expect($event)->toBeInstanceOf(Event::class)
            ->and($event->title)->toBeString()
            ->and($event->slug)->toBeString()
            ->and($event->user_id)->toBeInt();
    });

    it('can create multiple events', function () {
        $events = Event::factory()->count(3)->create();
        
        expect($events)->toHaveCount(3)
            ->and($events->first())->toBeInstanceOf(Event::class);
    });

    it('can create approved events', function () {
        $approvedEvent = Event::factory()->create(['is_approved' => true]);
        $unapprovedEvent = Event::factory()->create(['is_approved' => false]);
        
        expect($approvedEvent->is_approved)->toBeTrue()
            ->and($unapprovedEvent->is_approved)->toBeFalse();
    });
});
