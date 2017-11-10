@extends('admin.app')
@section('title') Users @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="users_listing_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Manage {{ $type }}
            <small>Here you can create, edit and delete {{ $type }}</small>
        </h1>
        <!-- END PAGE TITLE-->

        <div class="clearfix add_user_box">
            <div class="col-md-6">
                <div class="btn-group">
                    <a href="{{ url('/admin/'. $type .'s/create') }}" class="btn sbold green add_btn"><i class="fa fa-plus"></i> Add New {{ $type }}</a>
                </div>
            </div>
        </div>

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box white">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-group"></i>Pages table</div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="pages_table">
                    <thead>
                    <tr>
                        <th> Title </th>
                        <th>Author</th>
                        <th>Categories</th>
                        <th>Published at</th>
                        <th> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($posts->count())
                        @foreach($posts as $post)
                            <tr>
                                <td> {{ $post->title }} </td>
                                <td class="author"><a href="/admin/users/{{ $post->user->id }}/edit">{{ $post->user->name }}</a></td>
                                <td>
                                    @if($post->terms->count())
                                        @foreach($post->terms as $key => $term)
                                            {{ $key != 0 ? ', ' : '' }}
                                            <a href="/admin/terms/{{ $term->id }}/edit">{{ $term->name }}</a>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    {{ $post->published_at }}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs blue-chambray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">
                                            <li>
                                                <a href="{{ url("admin/posts/$post->id/edit") }}">
                                                    <i class="fa fa-file-text"></i> Edit {{ $type }} </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" onclick="postDelete(this);" >
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id]]) !!}
                                                    <i class="fa fa-trash"></i> Delete {{ $type }}
                                                    {!! Form::close() !!}
                                                </a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="{{ url("/$post->slug") }}">
                                                    <i class="fa fa-link"></i> Preview {{ $type }} </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

@endsection

@section('footer')
    <script src="{{ asset('admin_tmpl/js/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection