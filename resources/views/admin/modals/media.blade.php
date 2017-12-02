<div class="remodal modal-primary media-modal re-media" data-remodal-id="media" role="dialog">
    <div class="modal-content box-images">
        <div class="modal-header no-padding-bottom">
            <button type="button" class="close" data-remodal-action="close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Insert Media</h4>
            <div class="modal-tabs">
                <span class="active" data-tab="tab-library">Media Library</span>
                <span data-tab="tab-upload">Upload</span>
            </div>
        </div>
        <div class="modal-body">
            <div class="modal-tab tab-library active">
                <div id="medias_holder"></div>
                <br/><br/>
                <p>
                    <span id="load_more_medias" class="btn btn-default"><i class="fa fa-refresh"></i></span>
                </p>
            </div>
            <div class="modal-tab tab-upload">
                {!! Form::open(['url' => 'admin/media', 'class' => 'dropzone', 'files' => true]) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-remodal-action="cancel">Close</button>
            <input type="text" class="form-control pull-left" id="image_src" value="" style="max-width: 200px; margin-left: 10px;">
            <button type="button" class="btn green pull-right" id="media_confirm_btn" data-remodal-action="confirm">Insert into post</button>
            <button type="button" class="btn yellow-mint pull-right" id="edit_media">Edit</button>
        </div>
    </div>
</div>
