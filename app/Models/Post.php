<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Post extends Model
{
    use HasFactory;
    use HasSEO;

    protected $fillable = ['body', 'link_url', 'link_title', 'link_description', 'link_image','user_id'];

     /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'plain_description',
    ];


      /**
     * Get the plain text version of the description.
     *
     * @return string
     */
    public function getPlainDescriptionAttribute()
    {
        return strip_tags($this->body);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
}
