@extends('admin.app')
@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="users_listing_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> All {{ $term->name }}</h1>
        <!-- END PAGE TITLE-->

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box white">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-newspaper-o"></i>{{ $term->name }}</div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="news_table">
                    <thead>
                    <tr>
                        <th> Name </th>
                        <th> Author </th>
                        <th> Created </th>
                        <th> Actions </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($posts->count())
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <a href="{{ $post->url() }}" target="_blank">{{ $post->title }}</a>
                                </td>
                                <td>
                                    <a href="/admin/users/{{ $post->user->id }}/edit">{{ $post->user->name }} {{ $post->user->last_name }}</a>
                                </td>
                                <td>
                                    {{ $post->created_at->format('d M Y') }}
                                </td>
                                <td>
                                    <a href="/admin/posts/{{ $post->id }}/edit" class="label label-danger">Edit post</a>
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