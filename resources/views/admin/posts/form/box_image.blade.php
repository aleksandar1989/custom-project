<div class="sidebar_item clearfix">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Featured Image</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div id="featured_image_holder">
                @if(isset($post) && $post->media_id != null)
                    <img src="{{ $post->image() }}" width="100%"/>
                    <a href="#" id="remove_featured_image">Remove</a>
                @endif
            </div>
            <br/>
            <a href="#media" id="set_featured_image" class="btn btn-default">
                <i class="fa fa-image"></i>
                Set featured image
            </a>
            <input type="hidden" id="featured_image" name="media_id"
                   value="{{ isset($post) && $post->media_id != null ? $post->media_id : '' }}">
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>