function userDelete(e) {
    if (confirm('Are you sure?')) {
        $(e).find('form').submit();
    }
}

