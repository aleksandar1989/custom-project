@extends('admin.app')
@section('title') Update {{ $postType }} @endsection

@section('content')
    <div class="create_post_page">
        <!-- form start -->
        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['Admin\PostsController@update', $post->id]]) !!}
        {!! Form::hidden('id', $post->id) !!}
        @include('admin.' . $post->type . 's.form', ['action' => 'Update', 'type' => $postType])
        {!! Form::close() !!}
    </div>
    <!-- Media -->
    @include('admin.modals.media')
    <!-- Cropper -->
    @include('admin.modals.cropper')
@endsection
