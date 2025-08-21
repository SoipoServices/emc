<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;
use Spatie\Tags\HasTags;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Event extends Model implements Sitemapable
{
    use HasPhoto;
    use HasFactory;
    use HasTags;
    use Searchable;
    use HasSEO;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'address',
        'slug',
        'is_approved',
        'is_member_event',
        'user_id',
        'photo_path',
        'link'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'photo_url',
        'plain_description',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime:d-M-Y H:i',
        'end_date' => 'datetime:d-M-Y H:i',
        'is_approved' => 'boolean',
        'is_member_event' => 'boolean'
    ];

    /**
     * Get the plain text version of the description.
     *
     * @return string
     */
    public function getPlainDescriptionAttribute()
    {
        return strip_tags($this->description);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    #[SearchUsingPrefix(['title', 'slug', 'address'])]
    #[SearchUsingFullText(['description'])]
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'address' => $this->address,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeMemberEvent($query)
    {
        return $query->where('is_member_event', true);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo_path ? asset('storage/' . $this->photo_path) : null;
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: Str::limit($this->plain_description,180),
            author: $this->user->name,
            image: $this->photo_url
        );
    }

    public function toSitemapTag(): Url | string | array
    {
        // Simple return:
        return route('public.event.show',['slug'=>$this->slug] );
    }
}
