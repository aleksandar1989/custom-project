@extends('admin.app')
@section('title') User Create @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="slider_page_box">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Manage Slider
            <small>On this page you can add, edit and see your sliders</small>
        </h1>
        <!-- END PAGE TITLE-->

        <div class="add_slider_btn">
            <a href="{{ url('/admin/sliders/create') }}" class="btn sbold green">
                <i class="fa fa-plus"></i> Add New Slider
            </a>
        </div>

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box white sliders_table">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-group"></i>Sliders table</div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th> Title </th>
                        <th> URL </th>
                        <th> Content </th>
                        <th> Position </th>
                        <th> Type </th>
                        <th> Order </th>
                        <th> Created </th>
                        <th> Image </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($sliders)
                        @foreach($sliders as $slider)
                            <tr>
                                <td> {{ $slider->title }} </td>
                                <td> <div class="limit_content"> {{ $slider->url }} </div></td>
                                <td> <div class="limit_content"> {{ $slider->content }} </div></td>
                                <td> {{ $slider->position }} </td>
                                <td> {{ $slider->type }} </td>
                                <td> {{ $slider->order }} </td>
                                <td> {{ date('d M. Y', strtotime($slider->created_at)) }} </td>
                                <td>
                                    <img src="{{ asset("images/$slider->type/$slider->image") }}" alt="{{ $slider->title }}" class="img-responsive"> </td>
                                <td>
                                    <a href="{{ url("admin/sliders/$slider->id/edit") }}" class="btn btn-xs yellow"><i class="fa fa-edit"></i> Edit </a>
                                    <a href="javascript:void(0);" class="btn btn-xs red" onclick="sliderDelete(this);" >
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['sliders.destroy', $slider->id]]) !!}
                                        <i class="fa fa-times"></i> Delete
                                        {!! Form::close() !!}
                                    </a>
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