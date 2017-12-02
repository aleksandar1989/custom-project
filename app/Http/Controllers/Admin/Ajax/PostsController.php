<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    protected $allowed = [
        'multipleDestroy',
        'getData'
    ];

    /**
     * Detect action and call it
     * @param $action
     * @return mixed
     */
    public function init(Request $request){
        $action = $request->input('action');
        if( in_array($action, $this->allowed) && $request->ajax() )
            return $this->$action($request);
    }

    /**
     * Multiple delete posts
     * @param Request $request
     * @return array|string
     */
    public function multipleDestroy(Request $request) {
        // get all selected posts
        $posts = $request->input('posts');

        if(count($posts)) {
            foreach ($posts as $postId) {
                // delete post
                Post::find($postId)->syncDelete();
            }
            $message = [
                'flash_message' => 'Posts are deleted.',
                'flash_message_type' => 'success'
            ];
        } else {
            $message = [
                'flash_message' => 'You need to select at least one post.',
                'flash_message_type' => 'warning'
            ];
        }

        session()->flash('flash_message', $message['flash_message']);
        session()->flash('flash_message_type', $message['flash_message_type']);
    }

    /**
     * Get post data by id
     * @param Request $request
     * @return mixed
     */
    private function getData(Request $request) {
        $post = Post::with('Media')->findOrFail($request->input('postId'));
        $parent = $post->parent_id ? Post::find($post->parent_id) : 0;
        return [
            'post' => $post,
            'metas' => $post->metas,
            'parent' => $parent && $parent->hasRelation(language('code')) ? $parent->relation(language('code'))->id : 0
        ];
    }
}
