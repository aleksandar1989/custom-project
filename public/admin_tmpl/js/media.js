$(function () {
    // set default params
    var multiple_item_selection = true;
    var action = 'insert_into_post';
    var page = 1;

    // Filter items by Date
    $('#media_dates').change(function() {
        // get selected date
        var date = $(this).val();

        if(date != '')
            window.location.href = '/admin/media/' + date;
        else
            window.location.href = '/admin/media';
    });

    // Select media item
    $(document).on('click', '.media-item-mod', function() {
        if($(this).hasClass('media-item-selected')) {
            $(this).removeClass('media-item-selected');
            $(this).find('.delete-files').remove();
            $('#image_src').val("");
        } else {
            if(!multiple_item_selection)
                $('.media-item-mod').removeClass('media-item-selected');

            $(this).addClass('media-item-selected');
            $(this).append('<input type="hidden" class="delete-files" name="files[]" value="'+$(this).find('img').attr('id')+'">');
            $('#image_src').val($(this).find('img').attr('src'));
        }
    });

    // remove featured image
    $(document).on('click', '#remove_featured_image', function(e) {
        // empty image holder
        $(this).parent().html('');
        // empty image input
        $('#featured_image').val('');
    });

    // Insert into post or set featured image
    $(document).on('confirmation', '.re-media', function () {
        switch(action) {
            case 'insert_into_post':
                if($('.media-item-selected').length) {
                    $.each($('.media-item-selected'), function() {
                        var item = $(this).find('img').clone();
                        $("iframe").contents().find("body").append(item);
                    });
                }
                break;
            case 'set_featured_image':
                if($('.media-item-selected').length) {
                    var image = $('.media-item-selected img').attr('src');
                    var id = $('.media-item-selected img').attr('id');
                    // insert image into holder
                    $('#featured_image_holder').html('<img src="' + image + '" width="100%"/>');
                    $('#featured_image_holder').append('<a href="#" id="remove_featured_image">Remove</a>');
                    // set media_id
                    $('#featured_image').val(id);
                }
                break;
        }

        // remove class after confirmation
        $('.media-item').removeClass('media-item-selected');
    });

    // detect add media click
    $('#add_media').click(function() {
        // change button name
        $('#media_confirm_btn').html('Insert into post');
        // remove all selections
        $('.media-item-mod').removeClass('media-item-selected');
        // set multiple selection to true
        multiple_item_selection = true;
        // set action to insert_into_post
        action = 'insert_into_post';
    });

    // detect set featured image click
    $('#set_featured_image').click(function() {
        // change button name
        $('#media_confirm_btn').html('Set featured image');
        // remove all selections
        $('.media-item-mod').removeClass('media-item-selected');
        // set multiple selection to false
        multiple_item_selection = false;
        // set action to set_featured_image
        action = 'set_featured_image';
    });

    // change tabs (Media Library / Upload)
    $('.modal-tabs span').click(function() {
        $('.modal-tabs span').removeClass('active');
        $(this).addClass('active');

        $('.modal-tab').removeClass('active');
        $('.' + $(this).data('tab')).addClass('active');
    });

    // initial load more on modal opened
    $(document).on('opened', '.re-media', function () {
        if(page == 1)
            loadMore();
    });

    // load more action
    $('#load_more_medias').click(function() {
        loadMore();
    });

    // load more medias function
    function loadMore() {
        if(page != 0) {
            $('#load_more_medias').html('<i class="fa fa-refresh fa-spin"></i>');
            $.ajax({
                url: "/admin/ajax/media?page=" + page,
                method: "POST",
                dataType: "json",
                data: {
                    action: 'loadMore',
                    _token: $('meta[name="_token"]').attr('content')
                }
            }).done(function (data) {
                var items = $(data.data);

                if (items.length > 0) {
                    for (var i = 0; i < items.length; i++) {
                        var item_id = $(items[i]).attr('id');

                        if ($('#' + item_id).length == 0) { // check if already exist
                            $('#medias_holder').append($(items[i]));
                        }
                    }
                } else {
                    $('#medias_holder').html('No Media.');
                }

                var hasMore = data.hasMore;

                if (hasMore) {
                    page = page + 1;
                    $('#load_more_medias').show();
                } else {
                    page = 0;
                    $('#load_more_medias').remove();
                }

                $('#load_more_medias').html('LOAD MORE');

            });
        }
    }

    $('#image_src').click(function() {
        $(this).select();
    });

});
