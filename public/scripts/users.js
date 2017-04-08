

(function($) {

	// 实例化vue
	var vm = new Vue({
	    el: '#app',
	    data: {
            navShift: "1",
	    },
	    methods: {
            // 主导航切换
            navShiftEvent: function(event) {
                var obj = $(event.currentTarget);
                $(".nav-tabs").find("li").removeClass("active");
                $(obj).addClass("active");
                vm.navShift = obj.attr("data-shift");

                $(".item").find("span").removeClass("active");
                $(".item").find("span").eq(0).addClass("active");
            }, 
            // 子导航切换
            itemShiftEvent: function(event) {
                var obj = $(event.currentTarget);
                $(".item").find("span").removeClass("active");
                $(obj).addClass("active");
            }, 
	    },
	});

    
    $(function() {


    });

})(jQuery)