<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Spatie\Tags\HasTags;

class Event extends Model
{
    use HasFactory;
    use HasTags;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'slug', 'description', 'address', 'start_date', 'end_date', 'user_id','is_approved'];

      /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'is_approved' => 'boolean'
        ];
    }


    public function author():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
