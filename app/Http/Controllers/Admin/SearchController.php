<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Redirect to show
     * @param Request $request
     * @return array|string
     */
    public function index(Request $request) {
        if($request->input('text') != '') {
            return redirect('admin/search/' . $request->input('text'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Search results
     * @param $text
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($text) {
        // get post by title and content
        $posts = Post::whereRaw('(title LIKE "%'.$text.'%" OR content LIKE "%'.$text.'%" OR seo_title LIKE "%'.$text.'%")')
            ->paginate(10);

        return view('admin.search.show', compact('posts', 'text'));
    }

}
