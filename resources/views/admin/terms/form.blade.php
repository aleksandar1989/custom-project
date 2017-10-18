<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name">Name</label>
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter name...']) !!}
    @if($errors->first('name'))
        <span class="help-block">{{ $errors->first('name') }}</span>
    @endif
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug">Slug</label>
    {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'placeholder' => 'Enter slug...']) !!}
    @if($errors->first('slug'))
        <span class="help-block">{{ $errors->first('slug') }}</span>
    @endif
</div>

<div class="form-group {{ $errors->has('parent') ? 'has-error' : ''}}">
    <label for="parent">Parent</label>
    <select name="parent" id="parent" class="form-control">
        <option value="0">None</option>
        @if(count($categories))
            @foreach($categories as $category)
                @if(!in_array($category['id'], isset($term) ? $term->taxonomy->getChildren(true) : []))
                    <option value="{{ $category['id'] }}" {{ Input::old('parent') == $category['id'] || (isset($term) && $term->taxonomy->parent_id == $category['id']) ? 'selected' : '' }}>
                        @for($i = 0; $i < $category['level']; $i++)&nbsp;&nbsp;&nbsp;&nbsp;@endfor
                        {{ $category['name'] }}
                    </option>
                @endif
            @endforeach
        @endif
    </select>
    @if($errors->first('parent'))
        <span class="help-block">{{ $errors->first('parent') }}</span>
    @endif
</div>

<div class="form-group {{ $errors->has('template') ? 'has-error' : ''}}">
    <label for="template">Template</label>
    <select name="template" id="template" class="form-control">
        @if(count($templates))
            @foreach($templates as $key => $template)
                <option value="{{ $key }}" {{ isset($term) && $term->template == $key ? 'selected' : '' }} {{ !isset($term) && $key == 'default' ? 'selected' : '' }}>
                    {{ $template }}
                </option>
            @endforeach
        @endif
    </select>
    @if($errors->first('template'))
        <span class="help-block">{{ $errors->first('template') }}</span>
    @endif
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description...">{{ isset($term) ? $term->taxonomy->description : '' }}</textarea>
    @if($errors->first('description'))
        <span class="help-block">{{ $errors->first('description') }}</span>
    @endif
</div>