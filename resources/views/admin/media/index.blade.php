@extends('admin.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary box-images">
                    {!! Form::open(['route' => array('admin.media.destroy', 0), 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure you want to delete those files?");']) !!}
                    <div class="box-header with-border">
                        <h3 class="box-title">Media Library</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        {!! Form::select('media_dates', $dates, isset($mediaDate) ? $mediaDate : null, ['class' => 'form-control pull-left', 'style' => 'max-width: 130px;', 'id' => 'media_dates']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger pull-right']) !!}
                        <button type="button" class="btn btn-warning pull-right" id="edit_media">Edit</button>
                    </div><!-- /.box-body -->
                    <div class="box-footer tab-library active">
                        @if($medias->count())
                            @foreach($medias as $media)
                                <a href="javascript:void(0)" class="media-item media-item-lib" id="media_{{ $media->id }}">
                                    <img src="{{ $media->image() }}" height="100px" id="{{ $media->id }}" alt="">
                                </a>
                            @endforeach
                        @else
                            No media
                        @endif
                    </div>
                    <div class="box-footer text-right">
                        {!! $medias->render() !!}
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.box -->
            </div>
        </div>
    </section>

    @include('admin.modals.cropper')

@endsection

@section('header')
    <!-- Remodal -->
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/remodal/remodal-default-theme.css') }}">

    <!-- Cropper -->
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/cropper/dist/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/cropper/main.css') }}">
@endsection

@section('footer')
    <!-- Media Date filter -->
    <script src="{{ asset('admin_tmpl/dist/js/custom/media.js') }}"></script>

    <!-- Remodal -->
    <script src="{{ asset('admin_tmpl/plugins/remodal/remodal.min.js') }}"></script>

    <!-- Cropper -->
    <script src="{{ asset('admin_tmpl/plugins/cropper/dist/cropper.js') }}"></script>
    <script src="{{ asset('admin_tmpl/plugins/cropper/main.js') }}"></script>

    <script>
        // Select media item
        $('.media-item-lib').click(function() {
            if($(this).hasClass('media-item-selected')) {
                $(this).removeClass('media-item-selected');
                $(this).find('.delete-files').remove();
            } else {
                $(this).addClass('media-item-selected');
                $(this).append('<input type="hidden" class="delete-files" name="files[]" value="'+$(this).find('img').attr('id')+'">');
            }
        });
    </script>
@endsection