<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProviders extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        if(Schema::hasTable('languages')) {
            config([
                'laravellocalization.supportedLocales' => DB::table('languages')->pluck('name', 'code')->toArray(),

                'laravellocalization.useAcceptLanguageHeader' => true,

                'laravellocalization.hideDefaultLocaleInURL' => true
            ]);
        }
    }
}
