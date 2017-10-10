@extends('admin.app')
@section('title') Users @endsection

@section('header')
    <link href="{{ asset('admin_tmpl/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin_tmpl/css/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="language_listing_page">
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Languages
            <small>Here you can see all languages</small>
        </h1>
        <!-- END PAGE TITLE-->

        <div class="table-scrollable">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Code </th>
                    <th> Name </th>
                    <th> Delete  </th>
                </tr>
                </thead>
                <tbody>
                @if($languages->count())
                    @foreach($languages as $language)
                        <tr>
                            <td>{{ $language->id }}</td>
                            <td>{{ $language->code }}</td>
                            <td>{{ $language->name }}</td>
                            <td class="cat-action">
                                @if($language->id != 1)
                                    {!! Form::open(array('route' => array('languages.destroy', $language->id), 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure you want to delete this language?");')) !!}
                                    <button type="submit" class="btn btn-xs red">
                                        <i class="fa fa-remove"></i> Delete
                                    </button>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="3">No languages to display.</td>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('admin_tmpl/js/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection