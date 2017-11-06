<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'template'
    ];
    
    private static $terms = array();

    private $parentsPath = array();

    private $parent;

    /**
     * Get taxonomy
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxonomy() {
        return $this->hasOne('App\TermTaxonomy');
    }

    /**
     * Get all children
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children() {
        return $this->belongsToMany('App\Term', 'term_taxonomy', 'parent_id');
    }


    /**
     * Global get all terms
     * @return array
     */
    public static function getTerms($taxonomy) {
        self::getTermsLeveled($taxonomy);
        return self::$terms;
    }

    /**
     * Private get all terms leveled
     * @param int $parent
     * @param int $level
     * @return bool
     */
    private static function getTermsLeveled($taxonomy = 'category', $parent = 0, $level = 0) {
        $items = TermTaxonomy::where('parent_id', $parent)
            ->where('taxonomy', $taxonomy)
            ->where('language_id', language())
            ->get();

        if($items->count()) {
            foreach($items as $item) {
                $category = array(
                    'id' => $item->term->id,
                    'name' => $item->term->name,
                    'level' => $level,
                    'description' => $item->description,
                    'slug' => $item->term->slug
                );

                self::$terms[] = $category;
                self::getTermsLeveled($taxonomy, $item->term->id, $level + 1);
            }
        } else {
            return false;
        }
    }

    /**
     * Get term url
     * @return mixed
     */
    public function url() {
        // empty parents path
        $this->parentsPath = array();
        $parent = $this->find($this->taxonomy->parent_id);

        if($parent) {
            $this->parentsPath($parent);

            $this->parentsPath = array_reverse($this->parentsPath);

            $this->parentsPath[] = $this->slug;

            return '/category/' . implode('/', $this->parentsPath);
        } else {

            return '/category/' . $this->slug;
        }
    }

    /**
     * Get all posts
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts() {
        return $this->belongsToMany('App\Post');
    }

    /**
     * Delete post and synchronize usages
     * @return bool
     * @throws \Exception
     */
    public function syncDelete() {
        // get parent id
        $parentId = $this->taxonomy->parent_id;

        if($this->delete()) {
            // change parent_id for children
            foreach($this->children as $child) {
                $child->taxonomy()->update([
                    'parent_id' => $parentId
                ]);
            }

            return true;
        } else {
            return false;
        }
    }
}
