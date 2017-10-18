@extends('admin.app')
@section('title') Categories  @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="category_manage_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Manage Categories
            <small>Here you can create, edit and delete categories</small>
        </h1>
        <!-- END PAGE TITLE-->

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
                <div class="portlet box white">
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="category_table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Slug</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($categories))
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            <a href="/admin/terms/{{ $category['id'] }}/posts">
                                                @for($i = 0; $i < $category['level']; $i++)— @endfor
                                                {{ $category['name'] }}
                                            </a>
                                        </td>
                                        <td>{{ $category['description'] }}</td>
                                        <td>{{ $category['slug'] }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs blue-chambray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-left" role="menu">
                                                    <li>
                                                        <a href="{{ \App\Term::find($category['id'])->url() }}" target="_blank">
                                                            <i class="fa fa-info-circle"></i>Link to category
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="/admin/terms/{{ $category['id'] }}/edit">
                                                            <i class="fa fa-file-text"></i> Edit Category </a>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        {!! Form::open(array('route' => array('terms.destroy', $category['id']), 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure you want to delete this category?");')) !!}
                                                        <button type="submit" class="link_submit_btn">
                                                            <i class="fa fa-remove"></i>Delete
                                                        </button>
                                                        {!! Form::close() !!}

                                                    </li>
                                                </ul>
                                            </div>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.col -->
        </div>
    </section>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('admin_tmpl/js/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection