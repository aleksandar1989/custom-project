jQuery('#register-btn').click(function () {
	jQuery('.login-form').hide();
	jQuery('.register-form').show();
});

jQuery('#register-back-btn').click(function () {
	jQuery('.login-form').show();
	jQuery('.register-form').hide();
});

jQuery('#forget-password').click(function () {
	jQuery('.login-form').hide();
	jQuery('.forget-form').show();
});

jQuery('#back-btn').click(function () {
	jQuery('.login-form').show();
	jQuery('.forget-form').hide();
});

// init background slide images
$.backstretch([
		"../admin_tmpl/images/login/1.jpg",
		"../admin_tmpl/images/login/2.jpg",
		"../admin_tmpl/images/login/3.jpg",
		"../admin_tmpl/images/login/4.jpg"
	], {
		fade: 1000,
		duration: 8000
	}
);


