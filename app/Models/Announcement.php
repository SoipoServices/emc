<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    /** @use HasFactory<\Database\Factories\AnnouncementFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'scheduled_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
        ];
    }

    /**
     * Scope to get announcements that are scheduled for today or earlier.
     */
    public function scopeScheduled($query)
    {
        return $query->where('scheduled_at', '<=', now());
    }

    /**
     * Scope to get announcements ordered by scheduled date (latest first).
     */
    public function scopeLatestBySchedule($query)
    {
        return $query->orderBy('scheduled_at', 'desc');
    }

    /**
     * Scope to get the latest scheduled announcement.
     */
    public function scopeLatestScheduled($query)
    {
        return $query->scheduled()->latestBySchedule();
    }
}
