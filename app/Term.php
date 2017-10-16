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
}
