@extends('admin.app')
@section('title') User Create @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="slider_page_box">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Manage Slider
            <small>On this page you can add, edit and see your sliders</small>
        </h1>
        <!-- END PAGE TITLE-->

        {!! Form::open(['url' => 'admin/sliders', 'files' => true]) !!}
            @include('admin.sliders.form')

            <div class="form-actions">
                <button type="submit" class="btn green">Save</button>
            </div>
        {!! Form::close() !!}



    </div>

@endsection

@section('footer')
    <script src="{{ asset('admin_tmpl/js/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endsection