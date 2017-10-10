<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    protected $fillable = [
        'translate_word_id',
        'language_id',
        'value'
    ];

    /**
     * Translate key
     * @param $key
     */
    public static function key ($key) {
        // get current language id
        $lng = Language::where('code', locale())->first();

        $translate = self::join('translate_words', 'translates.translate_word_id', '=', 'translate_words.id')
            ->where('translate_words.key', $key)
            ->where('translates.language_id', $lng->id)
            ->first();

        return $translate ? $translate->value : $key;
    }
}
