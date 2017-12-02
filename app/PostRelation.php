<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostRelation extends Model
{
    protected $fillable = [
        'post_id',
        'post_relation_id',
        'language'
    ];
}
