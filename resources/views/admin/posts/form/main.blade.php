<div class="form-body">
    <div class="form-group form-md-line-input form-md-floating-label">
        {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) !!}
        <label for="title">Title</label>
        <span class="help-block">Enter title...</span>
    </div>

    <div class="form-group form-md-line-input form-md-floating-label">
        {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) !!}
        <label for="slug">Slug</label>
        <span class="help-block">Enter slug...</span>
    </div>

    <div class="form-group content_box">
        <label for="post_content">Content</label>
        <textarea name="content" class="form-control" rows="12" id="post_content">{{ isset($post) ? $post->content : '' }}</textarea>
    </div>
</div>
