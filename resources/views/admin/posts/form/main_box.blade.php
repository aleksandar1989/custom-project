{!! Form::hidden('type', $type) !!}
<div class="form-body">
    <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('title') ? 'has-error' : ''}}">
        {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title']) !!}
        <label for="title">Title</label>
        <span class="help-block">{{ $errors->first('title') ? $errors->first('title') : 'Enter title...' }}</span>
    </div>

    <div class="form-group form-md-line-input form-md-floating-label {{ $errors->has('slug') ? 'has-error' : ''}}">
        {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) !!}
        <label for="slug">Slug</label>
        <span class="help-block">{{ $errors->first('slug') ? $errors->first('slug') : 'Enter slug...' }}</span>
    </div>

    <div class="form-group content_box">
        <label for="post_content">Content</label>
        <textarea name="content" class="form-control" rows="12" id="post_content">{{ isset($post) ? $post->content : '' }}</textarea>
    </div>

    <div class="form-group form-md-line-input form-md-floating-label">
        <div class="input-icon right">
            {!! Form::text('seo_title', null, ['class' => 'form-control count_characters', 'id' => 'seo_title']) !!}
            <label for="seo_title">SEO Title</label>
            <span class="help-block"><span class="charNum">{{ isset($post) && $post->seo_title ? strlen($post->seo_title) : 0 }}</span></span>
            <i class="fa fa-eye"></i>
        </div>
    </div>

    <div class="form-group form-md-line-input form-md-floating-label">
        <div class="input-icon right">
            {!! Form::textarea('seo_description', null, ['class' => 'form-control count_characters', 'id' => 'seo_description', 'rows' => 3]) !!}
            <label for="seo_description">SEO Description</label>
            <span class="help-block"><span class="charNum">{{ isset($post) && $post->seo_description ? strlen($post->seo_description) : 0 }}</span></span>
            <i class="fa fa-eye"></i>
        </div>
    </div>
</div>
