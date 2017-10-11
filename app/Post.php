<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'language_id',
        'published_at',
    ];

    protected $dates = ['published_at']; // to be carbon instance


    public function publishedAt($format) {
        return Carbon::parse($this->published_at)->format($format);
    }

    /**
     * Set Published At
     * @param $date
     */
    public function setPublishedAtAttribute($date) {
        $this->attributes['published_at'] = $date ? Carbon::createFromFormat('d/m/Y H:i', $date) : Carbon::now();
    }

    /**
     * Get post url
     * @return string
     */
    public function url() {
        return '/' . $this->slug;

    }

    /**
     * Set slug
     * @param $name
     */
    public function setSlugAttribute($name) {
        // seo title or title
        $title = $this->seo_title ? $this->seo_title : $this->title;
        $this->attributes['slug'] = $name ? $this->getSlug($name) : $this->getSlug($title);
    }

    /**
     * Get author
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Get available slug
     * @param $name
     * @return string
     */
    private function getSlug($name)
    {
        $slug = Str::slug($name);

        $slugs = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'");

        if ($slugs->count() === 0) {

            return $slug;

        }

        // get reverse order and get first
        $lastSlugNumber = intval(str_replace($slug . '-', '', $slugs->orderBy('created_at', 'desc')->first()->slug));

        return $slug . '-' . ($lastSlugNumber + 1);
    }
}
