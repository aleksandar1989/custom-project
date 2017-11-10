@extends('admin.app')
@section('title') Create Post @endsection

@section('content')
    <div class="create_post_page">
        <!-- form start -->
        {!! Form::open(['url' => 'admin/posts']) !!}
        @include('admin.posts.form', ['action' => 'Post', 'type' => 'post'])
        {!! Form::close() !!}
    </div>

    <!-- Media -->
    @include('admin.modals.media')
    <!-- Cropper -->
    @include('admin.modals.cropper')
@endsection
