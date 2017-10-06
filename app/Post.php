<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'seo_title',
        'seo_description',
        'status',
        'template',
        'type',
        'published_at',
    ];

    protected $dates = ['published_at']; // to be carbon instance


    public function publishedAt($format) {
        return Carbon::parse($this->published_at)->format($format);
    }

    /**
     * Get post url
     * @return string
     */
    public function url() {
        return '/' . $this->slug;

    }

}
