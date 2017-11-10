@extends('admin.app')
@section('title') Create Page @endsection


@section('content')
    <div class="create_post_page">
        <!-- form start -->
        {!! Form::open(['url' => 'admin/posts']) !!}
            @include('admin.pages.form', ['action' => 'Post', 'type' => 'page'])
        {!! Form::close() !!}
    </div>

    <!-- Media -->
    @include('admin.modals.media')
    <!-- Cropper -->
    @include('admin.modals.cropper')
@endsection

