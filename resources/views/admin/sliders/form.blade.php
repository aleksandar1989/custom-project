<div class="form-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Title</label>
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter slider title...']) !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Target Url</label>
                {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'Enter site url where slider will target']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
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
                            {!! Form::file('image') !!}
                        </span>
                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Position</label>
                {!! Form::select('position', [ 'main_slider' => 'Main Slider'], null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Type</label>
                        {!! Form::select('type', [ 'slider' => 'slider', 'banner' => 'Banner'], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Position</label>
                        {!! Form::select('position', [ 'main_slider' => 'Main Slider'], null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>