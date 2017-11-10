<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $fillable = [
        'name',
        'folder',
        'type',
        'thumbnail'
    ];
    protected $table = 'medias';

    /**
     * Get available name
     * @param $name
     * @return string
     */
    public static function getName($name)
    {
        $slug = Str::slug($name);

        $slugs = self::whereRaw("name REGEXP '^{$slug}(-[0-9]*)?$'");

        if ($slugs->count() === 0) {

            return $slug;

        }

        // get reverse order and get first
        $lastSlugNumber = intval(str_replace($slug . '-', '', $slugs->orderBy('name', 'desc')->first()->name));

        return $slug . '-' . ($lastSlugNumber + 1);
    }

    /**
     * Get full image path
     * @return string
     */
    public function image() {
        return $this->folder . $this->name . '.' . $this->type;
    }

    /**
     * Get thumbnail full path
     * @return string
     */
    public function thumbnail() {
        return $this->folder . $this->name . '-' . $this->thumbnail . '.' . $this->type;
    }
}
