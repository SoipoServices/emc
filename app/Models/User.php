<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\Tags\HasTags;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasPhoto;
    use HasTags;
    use Impersonate;
    use Notifiable;
    use Searchable;
    use TwoFactorAuthenticatable;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['tags'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'telephone',
        'position',
        'city',
        'country',
        'bio',
        'site_url',
        'linkedin_profile_url',
        'facebook_url',
        'twitter_url',
        'youtube_url',
        'email_verified_at',
        'oauth_id',
        'oauth_type',
        'feedback_submitted_at',
        'is_disabled',
        'profile_photo_path',
        'is_visible',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'has_bio',
        'is_verified',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_visible' => 'boolean',
            'is_disabled' => 'boolean',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin && $this->hasVerifiedEmail();
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    #[SearchUsingPrefix(['name', 'email', 'telephone', 'position'])]
    #[SearchUsingFullText(['bio'])]
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'position' => $this->position,
            'city' => $this->city,
            'country' => $this->country,
            'bio' => $this->bio,
        ];
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    public function scopeHasBio($query)
    {
        return $query->whereNotNull('bio');
    }

    public function scopeHasPosition($query)
    {
        return $query->whereNotNull('position');
    }

    public function scopeIsVisible($query)
    {
        return $query->where('is_visible', true);
    }

    protected function hasBio(): Attribute
    {
        return Attribute::get(
            fn () => ! empty($this->bio)
        );
    }

    protected function isVerified(): Attribute
    {
        return Attribute::get(
            fn () => ! empty($this->email_verified_at)
        );
    }

    public function posts()
    {
        return $this->hasMany(\LaraZeus\Sky\Models\Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function savedLibraryItems()
    {
        return $this->belongsToMany(
            config('zeus-sky.models.Library'),
            'user_library',
            'user_id',
            'library_id'
        )->withTimestamps();
    }

    /**
     * Check if this user can impersonate other users.
     * Only admins can impersonate.
     */
    public function canImpersonate(): bool
    {
        return $this->is_admin;
    }

    /**
     * Check if this user can be impersonated.
     * All users can be impersonated except disabled ones.
     */
    public function canBeImpersonated(): bool
    {
        return !$this->is_disabled;
    }
}
