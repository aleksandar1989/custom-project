<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranslateWord extends Model
{
    protected $fillable = [
        'key'
    ];

    /**
     * Get all translates
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translates() {
        return $this->hasMany('App\Translate');
    }
}
