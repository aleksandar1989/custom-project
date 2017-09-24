@extends('admin.app')
@section('title') User Create @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="user_create_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Create User
            <small>Here you can create new user</small>
        </h1>
        <!-- END PAGE TITLE-->


        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-body form">
                <!-- form start -->
                {!! Form::open(['url' => 'admin/users', 'files' => true]) !!}

                    <div class="form-body">
                        @include('admin.errors.list')<br/>
                        @include('admin.users.form')
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn green">Submit</button>
                    </div>
                {!! Form::close() !!}



            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->


    </div>

@endsection

@section('footer')
    <script src="{{ asset('admin_tmpl/js/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endsection