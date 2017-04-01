

(function($) {

	//底部轮播图
    var bottombannerEvent = function() {
        $('.flickadd').flicker({dot_navigation: true});
    };

	// 实例化vue
	var vm = new Vue({
	    el: '#app',
	    data: {
	    	list: "",
	    },
	    methods: {
	        search:search, // 按钮搜索
	    }
	});


    // 请求接口加载列表数据
    function requestInterface() {
    	
        var params = {
             "_token": $("#app").attr("data-value")
        };

        $.post('/custome/loadlist', params, function(backData) {

            if(backData && backData.code === "S") {

                vm.list = backData.msg;
            }

        }, "json"); 
    };

    // 按钮搜索
    function search() {

        var keyword =escape($(".search input").val()); // 关键字

        if(keyword) {
            window.location.href = '/load_search?keyword='+keyword;
        }else {
            return false;
        }
    }

    $(function() {

		// 请求接口加载列表数据
	    requestInterface();

    });

})(jQuery)