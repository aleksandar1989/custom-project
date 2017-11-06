@if(count($templates))
    <div class="sidebar_item clearfix">
        <div class="form-group">
            <h3>Template</h3>
            <div class="md-radio-list">
                @foreach($templates as $key => $template)
                    <div class="md-radio">
                        <input type="radio" class="md-radiobtn" id="{{ $key }}" name="template"
                               value="{{ $key }}" {{ isset($post) && $post->template == $key ? 'checked' : '' }} {{ !isset($post) && $key == 'default' ? 'checked' : '' }}>
                        <label for="{{ $key }}">
                            <span class="inc"></span>
                            <span class="check"></span>
                            <span class="box"></span> {{ $template }} </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

<div class="sidebar_item clearfix">
    <div class="form-group">
        <h3>Parent</h3>
        <select name="parent_id" id="parent" class="form-control">
            <option value="0">No parent...</option>
            @if(count($postsLeveled))
                @foreach($postsLeveled as $postLeveled)
                    @if(!in_array($postLeveled['id'], isset($post) ? $post->getChildren(true) : []))
                        <option value="{{ $postLeveled['id'] }}" {{ Input::old('parent_id') == $postLeveled['id'] || (isset($post) && $post->parent_id == $postLeveled['id']) ? 'selected' : '' }}>
                            @for($i = 0; $i < $postLeveled['level']; $i++)&nbsp;&nbsp;&nbsp;&nbsp;@endfor
                            {{ $postLeveled['title'] }}
                        </option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>
</div>

<div class="sidebar_item clearfix">
    <div class="form-group spiner">
        <h3>Order</h3>
        {!! Form::input('number', 'order', null, ['min' => '0', 'class' => 'text-center order_input']) !!}
    </div>
</div>