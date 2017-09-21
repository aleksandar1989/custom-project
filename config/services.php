<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '132496160710297',
        'client_secret' => '87b5500ecc32b90ad03642ce55556a1a',
        'redirect' => env('FACEBOOK_LOGIN_URL'),
    ],

    'twitter' => [
        'client_id' => 'guCrEqbp5bKMs3PeXaXZnUHVZ',
        'client_secret' => 'fxcKt1O5sJ4LmgxUjMG5VXB60XFi6VzlAJWn4HZi5KFc7npdVi',
        'redirect' => env('TWITTER_LOGIN_URL'),
    ],

    'google' => [
        'client_id' => '872501363407-m91e3l9bre2sdfvospaekrs960pu5dh0.apps.googleusercontent.com',
        'client_secret' => '1WUZp0rB1W4WpAGGE86h1QyH',
        'redirect' => env('GOOGLE_LOGIN_URL'),
    ],

];
