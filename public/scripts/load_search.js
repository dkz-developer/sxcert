

(function($) {

	//底部轮播图
    var bottombannerEvent = function() {
        $('.flickadd').flicker({dot_navigation: true});
    };

    var keyword = unescape($.mytools.GetQueryString("keyword"));    // 关键字



	// 实例化vue
	var vm = new Vue({
	    el: 'html',
	    data: {
	    	list: "",
            keyword: keyword, // 关键字
	    },
	    methods: {
	        search:search, // 按钮搜索
	    }
	});


    // 请求接口加载列表数据
    function requestInterface() {
    	
        var params = {
            "keyword": vm.keyword,
             "_token": $("#app").attr("data-value"),
        };

        $.post('/custome/loadlist', params, function(backData) {

            if(backData && backData.code === "S") {

                vm.list = backData.msg;
            }

        }, "json"); 
    };

   //  关键字搜索
    function search(event) {

        var keyword = $(event.currentTarget).siblings("input").val();

        if(keyword) {
            vm.keyword = keyword;
            requestInterface(); 
        }
    };


    $(function() {

		// 请求接口加载列表数据
	    requestInterface();

    });

})(jQuery)