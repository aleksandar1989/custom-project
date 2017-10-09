<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Single post page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug) {

        // get whole url
        $posts = explode('/', $slug);

        // get category slug
        $post_slug = end($posts);

        // get post by slug
        $post = Post::where('slug', $post_slug)->first();

        return view('themes/laracus/'.$post->type . 's.' . $post->template, compact('post'));
    }
}
