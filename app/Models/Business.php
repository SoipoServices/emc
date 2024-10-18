<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Support\Str;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;


class Business extends Model implements Sitemapable
{
    use HasFactory;
    use Searchable;
    use HasPhoto;
    use HasSEO;



    protected $fillable = [
        'name',
        'slug',
        'url',
        'linkedin_url',
        'photo_path',
        'telephone',
        'email',
        'description',
        'priority',
        'is_sponsor',
        'is_public',
        'is_approved',
        'user_id'
    ];

    protected $casts = [
        'is_sponsor' => 'boolean',
        'is_public' => 'boolean',
        'is_approved' => 'boolean',
        'priority' => 'integer',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    #[SearchUsingPrefix(['name','slug'])]
    #[SearchUsingFullText(['description'])]
    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

     /**
     * Get the plain text version of the description.
     *
     * @return string
     */
    public function getPlainDescriptionAttribute()
    {
        return strip_tags($this->description);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->name,
            description: Str::limit($this->plain_description,180),
            author: $this->user->name,
            image: $this->photo_url
        );
    }

    public function toSitemapTag(): Url | string | array
    {
        // Simple return:
        return route('public.business.show',['slug'=>$this->slug] );
    }

}
