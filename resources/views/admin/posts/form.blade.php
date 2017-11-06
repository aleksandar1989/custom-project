<div class="row">
    <div class="col-lg-9">
        <div class="main-content bordered blog-container">
            <div class="head">
                <h1 class="main_title">{{ $action == 'Post' ? 'Add New' : 'Edit' }} {{ ucwords($type) }} <small>Here you can create new {{ $type }}</small></h1>
                <div class="post_date">
                    <i class="icon-calendar font-blue"></i>
                    {{ date('M d, Y') }}
                </div>
            </div>

            @include('admin.posts.form.main_box')

        </div>
    </div>
    <div class="col-lg-3">
        <div class="sidebar bordered blog-container">
            <!-- Publish box -->
            @include('admin.posts.form.publish_box')

            <!-- Templates box -->
            @include('admin.posts.form.attributes_box')

            <!-- Categories box -->
            @include('admin.posts.form.box_categories')

            <!-- Relations box -->
            @include('admin.posts.form.box_relations')
        </div>
    </div>
</div>