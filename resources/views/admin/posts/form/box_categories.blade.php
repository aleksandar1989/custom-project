@if(count($categories))
    <div class="sidebar_item clearfix">
        <div class="form-group">
            <h3>Categories</h3>
            <select name="categories[]" class="form-control select2" id="categories" data-placeholder="Select categories..." multiple="multiple">
                @foreach($categories as $category)
                    <option value="{{ $category['id'] }}" {{
                                Input::old('parent') == $category['id'] ||
                                in_array($category['id'], isset($post) ? $post->terms->pluck('id')->toArray() : []) ?
                                'selected' : '' }}>
                        @for($i = 0; $i < $category['level']; $i++)&nbsp;&nbsp;&nbsp;&nbsp;@endfor
                        {{ $category['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endif
