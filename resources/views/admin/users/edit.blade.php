@extends('admin.app')
@section('title') User Create @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="user_create_page">
        <h1 class="page-title"> Edit User
            <small>Here you can edit user</small>
        </h1>

        <div class="portlet light bordered">
            <div class="portlet-body form">
                {!! Form::model($user, ['method' => 'PATCH', 'files' => true, 'action' => ['Admin\UsersController@update', $user->id]]) !!}
                {!! Form::hidden('id', $user->id) !!}

                <div class="form-body">
                    @include('admin.users.form')
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn green">Update</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>

    </div>
@endsection

@section('footer')
    <script src="{{ asset('admin_tmpl/js/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endsection