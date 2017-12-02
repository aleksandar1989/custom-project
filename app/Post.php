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
        'parent_id',
        'slug',
        'content',
        'seo_title',
        'seo_description',
        'status',
        'media_id',
        'template',
        'order',
        'type',
        'language_id',
        'published_at',
    ];

    protected $dates = ['published_at']; // to be carbon instance
    
    private static $posts = array();

    private $children = array();



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

    /**
     * Global get all posts
     * @return array
     */
    public static function getPosts($type, $language = null) {
        echo $language;
        self::getPostsLeveled($type, 0, 0, $language);
        $returnPosts = self::$posts;
        // empty self posts
        self::$posts = array();
        return $returnPosts;
    }

    /**
     * Get media
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media() {
        return $this->belongsTo('App\Media');
    }

    /**
     * Get post image
     * @return string
     */
    public function image() {
        $media = $this->media;

        if($media) {
            return $media->image();
        }
    }

    /**
     * Get post thumbnail
     * @return string
     */
    public function thumbnail() {
        $media = $this->media;

        if($media) {
            return $media->thumbnail();
        }
    }

    /**
     * Private get all terms leveled
     * @param int $parent
     * @param int $level
     * @return bool
     */
    private static function getPostsLeveled($type = 'post', $parent = 0, $level = 0, $language = null) {
        if($language == null)
            $language = language();

        $items = self::where('parent_id', $parent)
            ->where('type', $type)
            ->where('language_id', $language)
            ->get();

        if($items->count()) {
            foreach($items as $item) {
                $post = array(
                    'id' => $item->id,
                    'title' => $item->title,
                    'level' => $level
                );

                self::$posts[] = $post;
                self::getPostsLeveled($type, $item->id, $level + 1, $language);
            }
        } else {
            return false;
        }
    }

    public function getChildren($withItself = false) {
        // add itself in array
        if($withItself)
            $this->children[] = $this->id;

        $this->getChildrenIds($this->id);
        return $this->children;
    }

    /**
     * Get all post categories
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function terms() {
        return $this->belongsToMany('App\Term');
    }

    /**
     * Private get all children arrayed
     * @param $parent_id
     */
    private function getChildrenIds($parent_id) {
        $children = self::where('parent_id', $parent_id)->get();

        if($children) {
            foreach($children as $child) {
                $this->children[] = $child->id;

                if(self::where('parent_id', $child->id)->count()) {
                    $this->getChildrenIds($child->id);
                }
            }
        }
    }

    /**
     * Get post relation by language
     * @param $language
     * @return string
     */
    public function relation($language) {
        $relation = $this->hasMany('App\PostRelation', 'post_id')->where('language', $language)->first();
        return Post::find($relation->post_relation_id);
    }

    /**
     * Check if post has relation
     * @param $language
     * @return mixed
     */
    public function hasRelation($language) {
        return $this->hasMany('App\PostRelation', 'post_id')->where('language', $language)->count();
    }
}
