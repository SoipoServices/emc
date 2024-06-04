<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;
use Spatie\Tags\HasTags;

class Event extends Model
{
    use HasPhoto;
    use HasFactory;
    use HasTags;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['photo_path', 'title', 'slug', 'description', 'address', 'start_date', 'end_date', 'is_approved', 'user_id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'datetime:d-M-Y H:00',
            'end_date' => 'datetime:d-M-Y H:00',
            'is_approved' => 'boolean'
        ];
    }


      /**
      * Get the indexable data array for the model.
      *
      * @return array<string, mixed>
      */
      #[SearchUsingPrefix(['title', 'slug','address'])]
      #[SearchUsingFullText(['description'])]
      public function toSearchableArray(): array
      {
          return [
              'id' => $this->id,
              'title' => $this->title,
              'slug' => $this->slug,
              'address' => $this->address,
              'toSearchableArray' => $this->toSearchableArray,
              'start_date' => $this->start_date,
              'end_date' => $this->end_date,
          ];
      }

      public function scopeApproved($query)
      {
          return $query->where('is_approved',true);
      }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
