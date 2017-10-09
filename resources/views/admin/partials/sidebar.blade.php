<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                {!! Form::open(['url' => '/admin/search', 'method' => 'get', 'class' => 'sidebar-search']) !!}
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text"  name="text"  class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                {!! Form::close() !!}
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>

            <li class="nav-item start {{ Request::path() == 'admin' ? 'active' : '' }}">
                <a href="{{ url('admin') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>

            </li>


            <li class="nav-item {{ (Request::path() == 'admin/pages' || Request::is('admin/pages/*')) ? 'active open' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-clone"></i>
                    <span class="title">Pages</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ Request::path() == 'admin/pages' ? 'active open' : '' }}">
                        <a href="{{ url('admin/pages') }}" class="nav-link">
                            <i class="fa fa-hdd-o"></i>
                            <span class="title">Manage Pages</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::path() == 'admin/pages/create' ? 'active open' : '' }}">
                        <a href="{{ url('admin/pages/create') }}" class="nav-link">
                            <i class="fa fa-file-text"></i>
                            <span class="title">Add Page</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item {{ (Request::path() == 'admin/users' || Request::is('admin/users/*')) ? 'active open' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Users</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  {{ Request::path() == 'admin/users' ? 'active open' : '' }}">
                        <a href="{{ url('admin/users') }}" class="nav-link ">
                            <i class="fa fa-users"></i>
                            <span class="title">Manage Users</span>
                        </a>
                    </li>
                    <li class="nav-item  {{ Request::path() == 'admin/users/create' ? 'active open' : '' }}">
                        <a href="{{ url('admin/users/create') }}" class="nav-link ">
                            <i class="fa fa-user"></i>
                            <span class="title">Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ (Request::path() == 'admin/sliders' || Request::is('admin/sliders/*')) ? 'active open' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-image"></i>
                    <span class="title">Sliders</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ Request::path() == 'admin/sliders' ? 'active open' : '' }}">
                        <a href="{{ url('admin/sliders') }}" class="nav-link">
                            <i class="fa fa-sliders"></i>
                            <span class="title">Manage Sliders</span>
                        </a>
                    </li>
                    <li class="nav-item {{ Request::path() == 'admin/sliders/create' ? 'active open' : '' }}">
                        <a href="{{ url('admin/sliders/create') }}" class="nav-link">
                            <i class="fa fa-file-image-o"></i>
                            <span class="title">Add Slider</span>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->

    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->