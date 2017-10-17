@extends('admin.app')
@section('title') Categories  @endsection

@section('header')

@endsection

@section('content')
    <div class="category_manage_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Manage Categories
            <small>Here you can create, edit and delete categories</small>
        </h1>
        <!-- END PAGE TITLE-->
    </div>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    {!! Form::open(['url' => 'admin/terms']) !!}
                    {!! Form::hidden('taxonomy', 'category') !!}
                    <div class="box-body">
                        @include('admin.terms.form')
                    </div><!-- /.box-body -->
  
                    <div class="box-footer">
                        <button type="submit" class="btn green">Add New Category</button>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.box -->
            </div>

            <!-- right column -->
            <div class="col-md-8">

            </div><!-- /.col -->
        </div>
    </section>
@endsection

@section('footer')

@endsection