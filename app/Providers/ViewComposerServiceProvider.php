<?php

namespace App\Providers;

use App\Role;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeDropdownRoles('admin.users.form');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Compose roles for dropdown
     */
    private function composeDropdownRoles($partial) {
        view()->composer($partial, function($view){
            // get all roles
            $roles = Role::all()->pluck('name', 'id')->toArray();

            $view->with('roles', $roles);
        });
    }
}
