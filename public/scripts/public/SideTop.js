$(function() {

	var style = [];
	var Code = [];

	style.push('#goTop {position: fixed; bottom: 0; right: 0; cursor: pointer; display: none;}');
	Code.push('<div id="goTop"><img src="http://gsmgood.com/images/top.png"/></div>');


	$("head").append("<style>"+style.join("")+"</style>");
	$("body").append(Code.join(""));


	$(window).scroll(function() {

		$(this).scrollTop()>=300 ? $("#goTop").fadeIn() : $("#goTop").fadeOut();
		
	});

	$("#goTop").click(function() {
		$("html body").animate({scrollTop: 0}, 300);
        $("html").animate({scrollTop: 0}, 300);
	});
})

