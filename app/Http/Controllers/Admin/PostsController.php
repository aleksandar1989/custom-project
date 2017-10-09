<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Create a new post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // create post
        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content'),
            'seo_title' => $request->input('seo_title'),
            'seo_description' => $request->input('seo_description'),
            'type' => $request->input('type'),
            'template' => $request->input('template'),
            'status' => '',
            'published_at' => $request->input('published_at'),
        ]);

        if($post) {
            $message = [
                'message' => 'Post has been created.',
                'type' => 'success'
            ];
        }else{
            $message = [
                'message' => 'Post has not been created.',
                'type' => 'danger'
            ];
        }

        return redirect('admin/posts/' . $post->id . '/edit')->with($message);
    }


    /**
     * Show the form for editing the post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get post
        $post = Post::find($id);

        $postType = $post->type;

        return view('admin.posts.edit', compact('post', 'postType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        // get post
        $post = Post::find($id);
        // set new values
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->seo_title = $request->input('seo_title');
        $post->seo_description = $request->input('seo_description');
        $post->template = $request->input('template');
        $post->published_at = $request->input('published_at');
        if($request->input('slug') != $post->slug) {
            $post->slug = $request->input('slug');
        }

        if($post->save()) {
            $message = [
                'message' => 'Post has been updated.',
                'type' => 'success'
            ];
        }else{
            $message = [
                'message' => 'Post has not been updated.',
                'type' => 'danger'
            ];
        }

        return redirect('admin/posts/' . $post->id . '/edit')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if($post->delete()) {
            $message = [
                'message' => 'Post has been deleted.',
                'type' => 'success'
            ];
        } else {
            $message = [
                'message' => 'Post has not been deleted.',
                'type' => 'danger'
            ];
        }

        return redirect()->back()->with($message);
    }
}
