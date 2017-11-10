$(document).on('click', '#edit_media', function() {
  var $btn = $(this);

  if($btn.closest('.box-images').find('.active .media-item-selected').length == 1) {

    'use strict';

    // set image src
    $('#image').attr('src', $btn.closest('.box-images').find('.active .media-item-selected img').attr('src'));

    var console = window.console || { log: function () {} };
    var $image = $('#image');
    var $dataX = $('#dataX');
    var $dataY = $('#dataY');
    var $dataHeight = $('#dataHeight');
    var $dataWidth = $('#dataWidth');
    var $dataRotate = $('#dataRotate');
    var $dataScaleX = $('#dataScaleX');
    var $dataScaleY = $('#dataScaleY');
    var $modal = $('[data-remodal-id=cropper]').remodal();
    var options = {
          aspectRatio: 'NaN',
          preview: '.img-preview',
          autoCropArea: 1,
          crop: function (e) {
            $dataX.val(Math.round(e.x));
            $dataY.val(Math.round(e.y));
            $dataHeight.val(Math.round(e.height));
            $dataWidth.val(Math.round(e.width));
            $dataRotate.val(e.rotate);
            $dataScaleX.val(e.scaleX);
            $dataScaleY.val(e.scaleY);
          }
        };

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Destroy options on start
    $image.cropper('destroy');

    // Cropper
    $image.cropper(options);

    // Buttons
    if (!$.isFunction(document.createElement('canvas').getContext)) {
      $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
    }

    if (typeof document.createElement('cropper').style.transition === 'undefined') {
      $('button[data-method="rotate"]').prop('disabled', true);
      $('button[data-method="scale"]').prop('disabled', true);
    }

    // Options
    $('.docs-toggles').on('change', 'input', function () {
      var $this = $(this);
      var name = $this.attr('name');
      var type = $this.prop('type');
      var cropBoxData;
      var canvasData;

      if (!$image.data('cropper')) {
        return;
      }

      if (type === 'checkbox') {
        options[name] = $this.prop('checked');
        cropBoxData = $image.cropper('getCropBoxData');
        canvasData = $image.cropper('getCanvasData');

        options.built = function () {
          $image.cropper('setCropBoxData', cropBoxData);
          $image.cropper('setCanvasData', canvasData);
        };
      } else if (type === 'radio') {
        options[name] = $this.val();
      }

      $image.cropper('destroy').cropper(options);
    });


    // Methods
    $('.docs-buttons').on('click', '[data-method]', function () {
      var $this = $(this);
      var data = $this.data();
      var $target;
      var result;

      if ($this.prop('disabled') || $this.hasClass('disabled')) {
        return;
      }

      if ($image.data('cropper') && data.method) {
        data = $.extend({}, data); // Clone a new one

        if (typeof data.target !== 'undefined') {
          $target = $(data.target);

          if (typeof data.option === 'undefined') {
            try {
              data.option = JSON.parse($target.val());
            } catch (e) {
              console.log(e.message);
            }
          }
        }

        result = $image.cropper(data.method, data.option, data.secondOption);

        switch (data.method) {
          case 'scaleX':
          case 'scaleY':
            $(this).data('option', -data.option);
            break;

          case 'getCroppedCanvas':
            if (result) {
              $this.attr('disabled', 'disabled');
              $this.html('<i class="fa fa-refresh fa-spin"></i>');

              var id = $btn.closest('.box-images').find('.active .media-item-selected img').attr('id');

              $.ajax({
                url: "/admin/ajax/media",
                method: "POST",
                dataType: "json",
                data: {
                  action: 'crop',
                  _token: $('meta[name="_token"]').attr('content'),
                  image: result.toDataURL(),
                  id: id
                }
              }).done(function (data) {
                if(data.status) {
                  var img = $('#media_' + id + ' img');
                  img.attr('src', img.attr('src') + '?timestamp=' + new Date().getTime())
                } else {
                  window.alert('An error occurred, please try again later.');
                }

                $modal.close();
                $this.removeAttr('disabled');
                $this.html('Save');
              });
            }

            $image.cropper('destroy');

            break;
        }

        if ($.isPlainObject(result) && $target) {
          try {
            $target.val(JSON.stringify(result));
          } catch (e) {
            console.log(e.message);
          }
        }

      }
    });


    // Keyboard
    $(document.body).on('keydown', function (e) {

      if (!$image.data('cropper') || this.scrollTop > 300) {
        return;
      }

      switch (e.which) {
        case 37:
          e.preventDefault();
          $image.cropper('move', -1, 0);
          break;

        case 38:
          e.preventDefault();
          $image.cropper('move', 0, -1);
          break;

        case 39:
          e.preventDefault();
          $image.cropper('move', 1, 0);
          break;

        case 40:
          e.preventDefault();
          $image.cropper('move', 0, 1);
          break;
      }

    });

    // Import image
    var $inputImage = $('#inputImage');
    var URL = window.URL || window.webkitURL;
    var blobURL;

    if (URL) {
      $inputImage.change(function () {
        var files = this.files;
        var file;

        if (!$image.data('cropper')) {
          return;
        }

        if (files && files.length) {
          file = files[0];

          if (/^image\/\w+$/.test(file.type)) {
            blobURL = URL.createObjectURL(file);
            $image.one('built.cropper', function () {

              // Revoke when load complete
              URL.revokeObjectURL(blobURL);
            }).cropper('reset').cropper('replace', blobURL);
            $inputImage.val('');
          } else {
            window.alert('Please choose an image file.');
          }
        }
      });
    } else {
      $inputImage.prop('disabled', true).parent().addClass('disabled');
    }

    // open modal
    $modal.open();

  } else {
    window.alert('You need to select one photo to edit.');
  }

});

// close modal if img is empty on modal opened
$(document).on('opened', '.re-cropper', function () {
  if($('#image').attr('src') == undefined) {
    // close modal
    var inst = $('[data-remodal-id=cropper]').remodal();
    inst.close();
  }
});

// destroy cropper on modal close
$(document).on('closed', '.re-cropper', function () {
  $('#image').cropper('destroy');
  // open media modal
  if($('[data-remodal-id=media]').length > 0) {
    var inst = $('[data-remodal-id=media]').remodal();
    inst.open();
  }
});