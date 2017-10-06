<div class="sidebar_item clearfix">
    <div class="form-group">
        <h3>Template</h3>
        @if(count($templates))
            <div class="md-radio-list">
                @foreach($templates as $key => $template)
                    <div class="md-radio">
                        <input type="radio" class="md-radiobtn" id="{{ $key }}" name="template" value="{{ $key }}" {{ isset($post) && $post->template == $key ? 'checked' : '' }} {{ !isset($post) && $key == 'default' ? 'checked' : '' }}>
                        <label for="{{ $key }}">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span>  {{ $template }} </label>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div><!-- /.box-body -->