@extends('admin.app')
@section('title') Slider Create @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="slider_create_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Create Slider
            <small>Here you can create new slider or banner</small>
        </h1>
        <!-- END PAGE TITLE-->


        <div class="sliders_form">
            {!! Form::open(['url' => 'admin/sliders', 'files' => true]) !!}
            @include('admin.sliders.form')

            <div class="form-actions">
                <button type="submit" class="btn green">Save</button>
            </div>
            {!! Form::close() !!}
        </div>


    </div>

@endsection

@section('footer')
    <script src="{{ asset('admin_tmpl/js/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endsection