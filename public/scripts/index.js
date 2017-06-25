

(function($) {

	//底部轮播图
    var bottombannerEvent = function() {
        $('.flickadd').flicker({dot_navigation: true});
    };

	// 实例化vue
	var vm = new Vue({
	    el: '#app',
	    data: {
	    	
	    },
	    methods: {
	        
	    }
	});



    $(function() {

	    bottombannerEvent();

	    $(".hot-post").find(".content ul").eq(0).show();
	    $(".hot-post").find(".tab-list").mouseover(function() {
	    	$(".hot-post").find(".tab-list").removeClass("active");
	    	$(this).addClass("active");

	    	var tabNum = $(this).attr("data-tab");

	    	$(".hot-post").find(".content ul").hide();

	    	$(".hot-post").find(".content ul[data-tab="+tabNum+"]").show();


	    });

    });

})(jQuery)