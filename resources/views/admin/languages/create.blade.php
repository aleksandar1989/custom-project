@extends('admin.app')
@section('title') Language Create @endsection

@section('content')
    <div class="add_languages_page">

        <h1 class="page-title"> Create New Language
            <small>Here you can create new language</small>
        </h1>
        <!-- END PAGE TITLE-->


        <!-- form start -->
        {!! Form::open(['url' => 'admin/languages']) !!}

        <div class="box-body">

            <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
                <label for="code">Code</label>
                {!! Form::text('code', null, ['class' => 'form-control', 'id' => 'code', 'placeholder' => 'Enter code...']) !!}
                @if($errors->first('code'))
                    <span class="help-block">{{ $errors->first('code') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                <label for="name">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter name...']) !!}
                @if($errors->first('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn green pull-right">Save</button>
        </div>

        {!! Form::close() !!}
    </div>
@endsection