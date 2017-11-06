<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Domain\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    /**
     * @var PostService
     */
    private $service;

    /**
     * PostsController constructor.
     * @param PostService $service
     */
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

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
        $postType = 'page';
        return view('admin.posts.create', compact('postType'));
    }

    /**
     * Create a new post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = $this->service->create($request->all());

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
        $post = $this->service->edit($id);
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
    public function update($id, PostRequest $request)
    {
        $this->service->update($id, $request->all());
        return redirect('admin/posts/' . $id . '/edit')->with(['message' => 'Post has been updated.',  'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->back()->with(['message' => 'Post has been deleted.', 'type' => 'success']);
    }
}
