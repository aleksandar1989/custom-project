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
        <h1 class="page-title"> Manage Users
            <small>Here you can create, edit and delete some user</small>
        </h1>
        <!-- END PAGE TITLE-->

        <div class="clearfix add_user_box">
            <div class="col-md-6">
                <div class="btn-group">
                    <a href="{{ url('/admin/users/create') }}" class="btn sbold green"> Add New User
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box white">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-group"></i>Users table</div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="users_table">
                    <thead>
                        <tr>
                            <th> User Name </th>
                            <th> Email </th>
                            <th> User Role </th>
                            <th> Status </th>
                            <th> Created </th>
                            <th> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td>
                                        @if($user->roles)
                                            @foreach($user->roles as $role)
                                            {{ $role->name  }}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <?php $status = $user->status ?>
                                        @if( $status == 1 )
                                            <span class="label label-sm label-success"> Approved </span>
                                        @elseif( $status == 2 )
                                            <span class="label label-sm label-warning"> Panding </span>
                                        @elseif( $status == 3 )
                                            <span class="label label-sm label-danger"> Blocked </span>
                                        @endif
                                    </td>
                                    <td> {{ date('d M. Y', strtotime($user->created_at)) }} </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-xs blue-chambray dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-left" role="menu">
                                                <li>
                                                    <a href="{{ url("admin/users/$user->id/edit") }}">
                                                        <i class="fa fa-file-text"></i> Edit User </a>
                                                </li>
                                                <li>
                                                    @if($user->id != 1)
                                                        <a href="javascript:void(0);" onclick="userDelete(this);" >
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
                                                        <i class="fa fa-trash"></i> Delete User
                                                        {!! Form::close() !!}
                                                        </a>
                                                    @endif

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