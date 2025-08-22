<?php

use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Str;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->business = Business::factory()->create([
        'name' => 'Test Business',
        'slug' => 'test-business',
        'description' => 'This is a test business description.',
        'email' => 'business@example.com',
        'telephone' => '+1234567890',
        'url' => 'https://example.com',
        'linkedin_url' => 'https://linkedin.com/company/test',
        'is_approved' => true,
        'is_public' => true,
        'is_sponsor' => false,
        'priority' => 5,
        'user_id' => $this->user->id,
    ]);
});

describe('Business Model', function () {
    it('can be created with valid attributes', function () {
        expect($this->business)->toBeInstanceOf(Business::class)
            ->and($this->business->name)->toBe('Test Business')
            ->and($this->business->slug)->toBe('test-business')
            ->and($this->business->email)->toBe('business@example.com')
            ->and($this->business->is_approved)->toBeTrue()
            ->and($this->business->is_public)->toBeTrue()
            ->and($this->business->is_sponsor)->toBeFalse()
            ->and($this->business->priority)->toBe(5);
    });

    it('casts boolean attributes correctly', function () {
        expect($this->business->is_approved)->toBeBool()
            ->and($this->business->is_public)->toBeBool()
            ->and($this->business->is_sponsor)->toBeBool();
    });

    it('casts integer attributes correctly', function () {
        expect($this->business->priority)->toBeInt();
    });

    it('has correct fillable attributes', function () {
        $fillable = $this->business->getFillable();
        
        expect($fillable)->toContain('name', 'slug', 'description', 'email', 'user_id')
            ->and($fillable)->toContain('is_approved', 'is_public', 'is_sponsor', 'priority');
    });

    it('appends photo_url and plain_description to array', function () {
        $businessArray = $this->business->toArray();
        
        expect($businessArray)->toHaveKey('photo_url')
            ->and($businessArray)->toHaveKey('plain_description');
    });

    it('generates plain description from HTML', function () {
        $businessWithHtml = Business::factory()->create([
            'description' => '<p>This is <strong>HTML</strong> content.</p>'
        ]);
        
        expect($businessWithHtml->plain_description)->toBe('This is HTML content.');
    });

    it('has searchable array configured correctly', function () {
        $searchableArray = $this->business->toSearchableArray();
        
        expect($searchableArray)->toHaveKeys(['name', 'description'])
            ->and($searchableArray['name'])->toBe($this->business->name)
            ->and($searchableArray['description'])->toBe($this->business->description);
    });
});

describe('Business Scopes', function () {
    it('can scope approved businesses', function () {
        Business::factory()->create(['is_approved' => false]);
        Business::factory()->create(['is_approved' => true]);
        
        $approvedBusinesses = Business::approved()->get();
        expect($approvedBusinesses)->toHaveCount(2); // Including the beforeEach business
    });

    it('can scope public businesses', function () {
        Business::factory()->create(['is_public' => false]);
        Business::factory()->create(['is_public' => true]);
        
        $publicBusinesses = Business::public()->get();
        expect($publicBusinesses)->toHaveCount(2); // Including the beforeEach business
    });

    it('can scope sponsor businesses', function () {
        Business::factory()->create(['is_sponsor' => true]);
        Business::factory()->create(['is_sponsor' => false]);
        
        $sponsorBusinesses = Business::sponsor()->get();
        expect($sponsorBusinesses)->toHaveCount(1);
    });
});

describe('Business Relationships', function () {
    it('belongs to a user', function () {
        expect($this->business->user)->toBeInstanceOf(User::class)
            ->and($this->business->user->id)->toBe($this->user->id);
    });

    it('can be created with user relationship', function () {
        $newUser = User::factory()->create();
        $newBusiness = Business::factory()->create(['user_id' => $newUser->id]);
        
        expect($newBusiness->user->id)->toBe($newUser->id);
    });
});

describe('Business SEO and Sitemap', function () {
    it('implements Sitemapable interface', function () {
        expect($this->business)->toBeInstanceOf(\Spatie\Sitemap\Contracts\Sitemapable::class);
    });

    it('generates dynamic SEO data', function () {
        $seoData = $this->business->getDynamicSEOData();
        
        expect($seoData)->toBeInstanceOf(\RalphJSmit\Laravel\SEO\Support\SEOData::class);
    });

    it('generates sitemap tag', function () {
        $sitemapTag = $this->business->toSitemapTag();
        
        expect($sitemapTag)->toBeString()
            ->and($sitemapTag)->toContain($this->business->slug);
    });
});

describe('Business Photo Management', function () {
    it('uses HasPhoto trait', function () {
        expect(in_array(\App\Traits\HasPhoto::class, class_uses($this->business)))->toBeTrue();
    });

    it('has photo_url accessor', function () {
        // Test with no photo
        expect($this->business->photo_url)->toBe('');
        
        // Test with photo path
        $businessWithPhoto = Business::factory()->create(['photo_path' => 'test-photo.jpg']);
        expect($businessWithPhoto->photo_url)->toContain('test-photo.jpg');
    });
});

describe('Business Factory', function () {
    it('can create business with factory', function () {
        $business = Business::factory()->create();
        
        expect($business)->toBeInstanceOf(Business::class)
            ->and($business->name)->toBeString()
            ->and($business->slug)->toBeString()
            ->and($business->user_id)->toBeInt();
    });

    it('can create multiple businesses', function () {
        $businesses = Business::factory()->count(3)->create();
        
        expect($businesses)->toHaveCount(3)
            ->and($businesses->first())->toBeInstanceOf(Business::class);
    });

    it('can create business with specific states', function () {
        $approvedBusiness = Business::factory()->create(['is_approved' => true]);
        $unapprovedBusiness = Business::factory()->create(['is_approved' => false]);
        
        expect($approvedBusiness->is_approved)->toBeTrue()
            ->and($unapprovedBusiness->is_approved)->toBeFalse();
    });
});
