<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'term_taxonomy';

    protected $fillable = [
        'parent_id',
        'taxonomy',
        'description',
        'language_id'
    ];

    private $children = array();

    /**
     * Get term
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function term() {
        return $this->belongsTo('App\Term', 'term_id', 'id');
    }

    public function getChildren($withItself = false) {
        // add itself in array
        if($withItself)
            $this->children[] = $this->term_id;

        $this->getChildrenIds($this->term_id);
        return $this->children;
    }

    /**
     * private get all children arrayed
     * @param $parent_id
     */
    private function getChildrenIds($parent_id) {
        $children = TermTaxonomy::where('parent_id', $parent_id)->get();

        if($children) {
            foreach($children as $child) {
                $this->children[] = $child->term_id;

                if(TermTaxonomy::where('parent_id', $child->term_id)->count()) {
                    $this->getChildrenIds($child->term_id);
                }
            }
        }
    }
}
