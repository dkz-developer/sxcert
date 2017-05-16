

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

    });

})(jQuery)