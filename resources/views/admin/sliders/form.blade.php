<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group  {{ $errors->has('title') ? 'has-error' : ''}}">
                <label class="control-label">Title</label>
                {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'Enter slider title...']) !!}
                @if($errors->first('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Target Url</label>
                {!! Form::text('url', null, ['id' => 'url', 'class' => 'form-control', 'placeholder' => 'Enter site url where slider will target']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group  {{ $errors->has('image') ? 'has-error' : ''}}">
                <label class="control-label">Image</label>
                <div class="fileinput fileinput-new image_box" data-provides="fileinput">
                    <div class="input-group input-large">
                        <div class="form-control uneditable-input input-fixed input-large" data-trigger="fileinput">
                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                            <span class="fileinput-filename"> </span>
                        </div>
                        <span class="input-group-addon btn default btn-file">
                            <span class="fileinput-new"> Select image </span>
                            <span class="fileinput-exists"> Change </span>
                            {!! Form::file('image', ['id' => 'slider_image']) !!}
                        </span>
                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>
                @if($errors->first('image'))
                    <span class="help-block">{{ $errors->first('image') }}</span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group {{ $errors->has('position') ? 'has-error' : ''}}">
                <label class="control-label">Position</label>
                {!! Form::select('position', [ 'main_slider' => 'Main Slider'], null, ['id' => 'position', 'class' => 'form-control']) !!}
                @if($errors->first('position'))
                    <span class="help-block">{{ $errors->first('position') }}</span>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Content</label>
                {!! Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control', 'rows' => 5, 'placeholder' => 'Enter the text whic be displayed on the slider']) !!}
            </div>

        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group  {{ $errors->has('type') ? 'has-error' : ''}}">
                        <label class="control-label">Type</label>
                        <div class="clearfix">
                            <div class="option_box">
                                <label for="slider">Slider</label>
                                {{ Form::radio('type', 'slider', true, ['class' => 'make-switch slider', 'data-size' => 'small']) }}
                            </div>
                            <div class="option_box">
                                <label for="baner">Banner</label>
                                {{ Form::radio('type', 'banner', false, ['class' => 'make-switch banner', 'data-size' => 'small']) }}
                            </div>
                        </div>
                        @if($errors->first('type'))
                            <span class="help-block">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <label class="control-label">Order</label>
                    <div class="form-group spiner">
                        {!! Form::number('order', null, ['id' => 'order', 'class' => 'form-control', 'min' => 0]) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>