<?php

/**
 * Custom Helpers
 */
use App\Language;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        return Language::where('code', $code)->get();
    }
}
