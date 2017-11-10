<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Show all pages
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        // get all pages
        $type = "page";
        $posts = Post::where('type', 'page')->where('language_id', language())->get();
        return view('admin.posts.index', compact('posts', 'type'));
    }

    /**
     * Create new page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        $postType = 'page';

        return view('admin.pages.create', compact('postType'));
    }
}
