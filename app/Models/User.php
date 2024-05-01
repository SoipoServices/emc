<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
 use Laravel\Scout\Attributes\SearchUsingFullText;
 use Laravel\Scout\Attributes\SearchUsingPrefix;
 use Laravel\Scout\Searchable;
 use Spatie\Tags\HasTags;

 class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasTags;
    use Searchable;

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
        'bio',
        'site_url',
        'linkedin_profile_url',
        'facebook_url',
        'twitter_url',
        'youtube_url'
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
            'is_admin' => 'boolean'
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
     #[SearchUsingPrefix(['name', 'email','telephone','position'])]
     #[SearchUsingFullText(['bio'])]
     public function toSearchableArray(): array
     {
         return [
             'id' => $this->id,
             'name' => $this->name,
             'email' => $this->email,
             'bio' => $this->bio,
         ];
     }
}
