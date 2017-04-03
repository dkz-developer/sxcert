

(function($) {


	// 实例化vue
	var vm = new Vue({
	    el: '#app',
	    data: {
	    	detail: "",
	    },
	    methods: {
	    }
	});


    // 请求接口加载列表数据
    function requestInterface() {
    	
        var params = {
             "_token": $("#app").attr("data-value")
        };

        $.post('/custome/detail', params, function(backData) {

            if(backData && backData.code === "S") {

                vm.detail = backData.msg;
            }

        }, "json"); 
    };

    $(function() {

		// 请求接口加载列表数据
	    requestInterface();

    });

})(jQuery)