<?php

/**
 * Custom Helpers
 */
use App\Language;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use \Illuminate\Support\Facades\Redis;


/**
 * Get theme View
 */
if (! function_exists('themeView')) {
    function themeView($asset)
    {
        return  '/themes/'. env('DEFAULT_THEME') .'/'. $asset;
    }
}

/**
 * Get locale language
 */
if (! function_exists('locale')) {
    function locale()
    {
        return LaravelLocalization::getCurrentLocale();
    }
}

/**
 * Get all locales
 */
if (! function_exists('locales')) {
    function locales()
    {
        return LaravelLocalization::getSupportedLocales();
    }
}

/**
 * Get language id by code
 */
if (! function_exists('languageIdByCode')) {
    function languageIdByCode($code)
    {
        return Language::where('code', $code)->first()->id;
    }
}

/**
 * Get language code by id
 */
if (! function_exists('languageById')) {
    function languageById($id)
    {
        return Language::find($id);
    }
}

/**
 * Get admin language
 */
if (! function_exists('language')) {
    function language($action = 'id')
    {
        if(!Redis::get('language_' . Session::getId())) {
            Redis::set('language_' . Session::getId(), 1);
        }

        if($action == 'id') {
            return Redis::get('language_' . Session::getId());
        } else if($action == 'code') {
            $lang = language::findOrFail(Redis::get('language_' . Session::getId()));
            return $lang->code;
        }

    }
}