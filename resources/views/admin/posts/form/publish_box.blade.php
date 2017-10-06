<div class="sidebar_item clearfix">
    <h3>Publish On:</h3>
    <div class="form-group">
        <div class="input-group date form_datetime bs-datetime">
            {!! Form::text('published_at', isset($post) ? $post->published_at->format('d/m/Y H:i') : null, ['class' => 'form-control', 'id' => 'published_at']) !!}
            <span class="input-group-addon">
                <button class="btn default date-set" type="button">
                    <i class="fa fa-calendar"></i>
                </button>
            </span>
        </div>
    </div>
    @if($action == 'Update')
        <a href="{{ $post->url() }}" class="btn yellow-mint" target="_blank">Preview</a>
    @endif
    {!! Form::submit($action, ['class' => ' btn green pull-right']) !!}

</div>