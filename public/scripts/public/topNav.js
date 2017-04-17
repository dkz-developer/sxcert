
(function($) {

    $(function() {

	   $(".login-btn, .register-btn").click(function() {

			$.mytools.addCookie("backURL",window.location.href);

		});

    });

})(jQuery)