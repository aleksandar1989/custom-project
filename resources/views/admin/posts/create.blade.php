@extends('admin.app')
@section('title') Create Post @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/select2.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="create_post_page">
        <!-- form start -->
        {!! Form::open(['url' => 'admin/posts']) !!}
        @include('admin.posts.form', ['action' => 'Post', 'type' => 'post'])
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
    <script src="{{ asset('admin_tmpl/js/select2.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() { $("#categories").select2(); });
    </script>
@endsection