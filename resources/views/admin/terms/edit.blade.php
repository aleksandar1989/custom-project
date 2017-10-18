@extends('admin.app')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <h1 class="page-title"> Edit Categories
                        <small>Here you can edit your category</small>
                    </h1>

                    <!-- form start -->
                    {!! Form::model($term, ['method' => 'PATCH', 'action' => ['Admin\TermsController@update', $term->id]]) !!}
                    {!! Form::hidden('taxonomy', $term->taxonomy->taxonomy) !!}
                    {!! Form::hidden('id', $term->id) !!}
                    <div class="box-body">
                        @include('admin.terms.form')
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn green">Update</button>
                        <a href="{{ $term->url() }}" target="_blank" class="btn yellow-mint pull-right">Preview</a>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection