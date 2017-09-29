

// spiner functionality

// delete user on submit function
function userDelete(e) {
    if (confirm('Are you sure?')) {
        $(e).find('form').submit();
    }
}