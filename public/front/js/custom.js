$(document).ready(function(){

    // language change
    $( ".language" ).on( "click", function( event ) {
        var curentLang = $(this).attr('name');
        var _token = $("input[name=_token]").val();

        $('#lanNavSel').text(curentLang);

        $.ajax({
            url: "/language",
            type: 'POST',
            data: { locale : curentLang, _token: _token },
            datatype:'json',
                success: function (data) {

            },
            error: function(data){

            },
            beforeSend: function () {

            },
            complete: function(data){
                window.location.reload(true);
            }

        });
    });
});