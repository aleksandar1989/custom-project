@extends('admin.app')
@section('title') Update {{ $postType }} @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="create_post_page">
        <!-- form start -->
        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['Admin\PostsController@update', $post->id]]) !!}
        {!! Form::hidden('id', $post->id) !!}
        @include('admin.pages.form', ['action' => 'Update', 'type' => $postType])
        {!! Form::close() !!}
    </div>

@endsection

@section('footer')
    <script src="{{ asset('admin_tmpl/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/components-date-time-pickers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/post.js') }}" type="text/javascript"></script>
@endsection
