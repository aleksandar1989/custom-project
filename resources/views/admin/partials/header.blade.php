<!-- BEGIN HEADER INNER -->
<div class="page-header-inner ">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
        <a href="{{ url('/admin') }}">
            <img src="{{ asset('admin_tmpl/images/theme_img/logo.png') }}" alt="logo" class="logo-default"/> </a>
        <div class="menu-toggler sidebar-toggler">
            <span></span>
        </div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
       data-target=".navbar-collapse">
        <span></span>
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown language_select">
                <a>
                    {!! Form::open(['method' => 'PATCH', 'action' => ['Admin\LanguagesController@update', 0]]) !!}
                    {!! Form::select('language', locales(), language('code'), ['class' => 'btn grey-mint btn-xs', 'onchange' => 'this.form.submit()']) !!}
                    {!! Form::close() !!}
                </a>
            </li>
            <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                   data-close-others="true">
                    <img alt="" class="img-circle" src="{{ (Auth::user()->meta('avatar')) ? Auth::user()->meta('avatar') : '/images/users/avatar-default.png' }}">
                    <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                    <i class="fa fa-angle-down"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-default">
                    <li>
                        <a href="page_user_profile_1.html">
                            <i class="icon-user"></i> My Profile </a>
                    </li>
                    <li>
                        <a href="app_inbox.html">
                            <i class="icon-envelope-open"></i> My Inbox
                            <span class="badge badge-danger"> 3 </span>
                        </a>
                    </li>

                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="icon-key"></i> Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
        </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
</div>
<!-- END HEADER INNER -->