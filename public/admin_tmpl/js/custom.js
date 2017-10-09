
// delete user on submit function
function userDelete(e) {
    if (confirm('Are you sure?')) {
        $(e).find('form').submit();
    }
}

// delete post on submit function
function postDelete(e) {
    if (confirm('Are you sure?')) {
        $(e).find('form').submit();
    }
}

// delete slider on submit function
function sliderDelete(e) {
    if (confirm('Are you sure?')) {
        $(e).find('form').submit();
    }
}

$('.count_characters').keyup(function() {
    var len = $(this).val().length;
    $(this).parent().find('.charNum').text(len);
});
