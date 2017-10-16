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
}
