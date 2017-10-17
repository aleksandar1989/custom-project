<?php

namespace App\Providers;

use App\Post;
use App\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
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
        $this->composeAttributes('admin.terms.form');
        $this->composeAttributes('admin.posts.form.attributes_box');
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

    /**
     * compose templates
     */
    private function composeAttributes($action) {
        view()->composer($action, function($view){
            // get url path
            $path = explode('/', Request::path());

            // get action (create or edit)
            $action = last($path);
            //get type (posts or pages)
            $type = $path[1];

            $files = array();
            $postId = 0;
            // get type post/page
            $postType = substr($type, 0, -1);

            switch($action) {
                case 'create':
                    // get templates
                    $files = File::allFiles(resource_path('views/themes/'. env('DEFAULT_THEME') . '/' . $type));
                    break;
                case 'category':
                    // get templates
                    $files = File::allFiles(resource_path('views/themes/'. getenv('DEFAULT_THEME') . '/' . $type));
                    break;
                case 'edit':
                    switch($type) {
                        case 'posts':
                            // get post id
                            $postId = $path[2];
                            // get post
                            $post = Post::find($postId);
                            //get templates for post type (page or post)
                            $files = File::allFiles(resource_path('views/themes/'. env('DEFAULT_THEME') . '/' . $post->type . 's'));

                            // set post type
                            $postType = $post->type;

                            break;
                        case 'terms':
                            //get templates
                            $files = File::allFiles(resource_path('views/themes/'. env('DEFAULT_THEME') . '/terms'));
                            break;
                    }

                    break;

            }

            $templates = [];

            foreach($files as $file) {
                $exp = explode('.', last(explode('/', $file->getFilename())));
                $templates[$exp[0]] = ucwords(str_replace('_', ' ', $exp[0]));
            }
            asort($templates);
            // get posts for dropdown parent
            $postsLeveled = Post::getPosts($postType);

            $view->with(compact('templates', 'postsLeveled'));
        });
    }
}
