@section('header')
    <!-- Data Picker -->
    <link href="{{ asset('admin_tmpl/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Select2 -->
    <link href="{{ asset('admin_tmpl/css/select2.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Remodal -->
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/remodal/remodal.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/remodal/remodal-default-theme.css') }}">

    <!-- Dropzone -->
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/dropzone/basic.css') }}">

    <!-- Cropper -->
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/cropper/dist/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_tmpl/plugins/cropper/main.css') }}">
@endsection


@section('footer')
    <script src="{{ asset('admin_tmpl/plugins/tinymce/tinymce.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/components-date-time-pickers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/plugins/input-mask/jquery.inputmask.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/plugins/input-mask/jquery.inputmask.extensions.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/post.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_tmpl/js/select2.js') }}" type="text/javascript"></script>
    <!-- Dropzone -->
    <script src="{{ asset('admin_tmpl/plugins/dropzone/dropzone.js') }}"></script>

    <!-- Remodal -->
    <script src="{{ asset('admin_tmpl/plugins/remodal/remodal.min.js') }}"></script>

    <!-- Media -->
    <script src="{{ asset('admin_tmpl/js/media.js') }}"></script>

    <!-- Cropper -->
    <script src="{{ asset('admin_tmpl/plugins/cropper/dist/cropper.js') }}"></script>
    <script src="{{ asset('admin_tmpl/plugins/cropper/main.js') }}"></script>
    <script>
        $(document).ready(function() { $("#categories").select2(); });

        $('.fill-data').click(function() {
            var postId = $(this).parent().find('.relation-posts').find(':selected').val();

            if(postId != '') {
                $.ajax({
                    url: "/admin/ajax/posts",
                    method: "POST",
                    dataType: "json",
                    data: {
                        action: 'getData',
                        _token: $('meta[name="_token"]').attr('content'),
                        postId: postId
                    }
                }).done(function (data) {
                    $('input[name="title"]').val(data.post.title);
                    $("iframe").contents().find("body").html(data.post.content);
                    $("input[name=template][value=" + data.post.template + "]").prop('checked', true);
                    $('input[name="order"]').val(data.post.order);
                    $('input[name="media_id"]').val(data.post.media_id);
                    $('select[name="parent_id"]').val(data.parent);

                    // add image into holder
                    $('#featured_image_holder').html('');
                    if(data.post.media_id) {
                        $('#featured_image_holder').html('<img src="' + data.post.media.folder + data.post.media.name + '.' + data.post.media.type + '" width="100%"/>');
                        $('#featured_image_holder').append('<a href="#" id="remove_featured_image">Remove</a>');
                    }

                    // add metas
                    $('.meta-rows').html('');
                    $.each(data.metas, function(key, value) {
                        $('.meta-rows').append(
                                '<tr valign="top">' +
                                '<td><label>' + value.meta_key + ' &nbsp;</label>' +
                                '<td><i class="fa fa-angle-double-right"></i>&nbsp;</td>' +
                                '<td><label><textarea rows="1" cols="50" name="metas[' + value.meta_key + ']">' + value.meta_value + '</textarea></label>&nbsp;</td>' +
                                '<td><button class="btn btn-danger btn-xs remove-custom-field"><i class="fa fa-remove"></i></button></td>' +
                                '</tr>'
                        );
                    });
                });
            }
        });

        // Character counter
        $('.count_characters').keyup(function() {
            var counter = $(this).val().length;
            $(this).parent().find('.char_counter').html(counter);
        });
    </script>
@endsection