<div class="remodal modal-primary media-modal re-cropper" data-remodal-id="cropper" role="dialog">
    <div class="modal-content">
        <div class="modal-header no-padding-bottom">
            <button type="button" class="close" data-remodal-action="close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Photo</h4>
        </div>
        <div class="modal-body">

            <!-- Content -->
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <!-- <h3 class="page-header">Demo:</h3> -->
                        <div class="img-container">
                            <img id="image">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- <h3 class="page-header">Preview:</h3> -->
                        <div class="docs-preview clearfix">
                            <div class="img-preview preview-lg"></div>
                        </div>

                        <!-- <h3 class="page-header">Data:</h3> -->
                        <div class="docs-data">
                            <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataX">X</label>
                                <input type="text" class="form-control" id="dataX" placeholder="x" disabled>
                                <span class="input-group-addon">px</span>
                            </div>
                            <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataY">Y</label>
                                <input type="text" class="form-control" id="dataY" placeholder="y" disabled>
                                <span class="input-group-addon">px</span>
                            </div>
                            <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataWidth">Width</label>
                                <input type="text" class="form-control" id="dataWidth" placeholder="width" disabled>
                                <span class="input-group-addon">px</span>
                            </div>
                            <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataHeight">Height</label>
                                <input type="text" class="form-control" id="dataHeight" placeholder="height" disabled>
                                <span class="input-group-addon">px</span>
                            </div>
                            <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataRotate">Rotate</label>
                                <input type="text" class="form-control" id="dataRotate" placeholder="rotate" disabled>
                                <span class="input-group-addon">deg</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 docs-buttons">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Move">
                                  <span class="fa fa-arrows"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Crop">
                                  <span class="fa fa-crop"></span>
                                </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Zoom In">
                                  <span class="fa fa-search-plus"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Zoom Out">
                                  <span class="fa fa-search-minus"></span>
                                </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Move Left">
                                  <span class="fa fa-arrow-left"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Move Right">
                                  <span class="fa fa-arrow-right"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Move Up">
                                  <span class="fa fa-arrow-up"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Move Down">
                                  <span class="fa fa-arrow-down"></span>
                                </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Rotate Left">
                                  <span class="fa fa-rotate-left"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Rotate Right">
                                  <span class="fa fa-rotate-right"></span>
                                </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Flip Horizontal">
                                  <span class="fa fa-arrows-h"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Flip Vertical">
                                  <span class="fa fa-arrows-v"></span>
                                </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Reset">
                                  <span class="fa fa-refresh"></span>
                                </span>
                            </button>
                            <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                <span class="docs-tooltip" data-toggle="tooltip" title="Import">
                                  <span class="fa fa-upload"></span>
                                </span>
                            </label>
                        </div>

                    </div><!-- /.docs-buttons -->

                </div>
            </div>

            <input type="hidden" id="media_id" />

        </div>
        <div class="modal-footer docs-buttons">
            <button type="button" class="btn btn-outline pull-left" data-remodal-action="cancel">Close</button>
            <button type="button" class="btn btn-outline" data-method="getCroppedCanvas">Save</button>
        </div>
    </div>
</div>