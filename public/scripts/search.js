

(function($) {

    var keyword = unescape($.mytools.GetQueryString("keyword"));    // 关键字

	// 实例化vue
	var vm = new Vue({
	    el: '#app',
	    data: {
	    	list: "",
            keyword: keyword, // 关键字
	    },
	    methods: {
	        search:search, // 按钮搜索
	    },
        // 过滤器 取整
        filters: {
            escape: function(value) {
                return escape(value);
            }
        }
	});


    // 请求接口加载列表数据
    function requestInterface(setting) {
    	
        var params = {
            "keyword": vm.keyword,
            "page": setting && setting.page ? setting.page : "1",
             "_token": $("#app").attr("data-value"),
        };

        $.post('/custome/loadlist', params, function(backData) {

            if(backData && backData.code === "S") {

                vm.list = backData.msg;

                createSplitPage(backData);
            }

        }, "json"); 
    };

   // 生成分页
    function createSplitPage(dataJson){

        var currentPage = dataJson.page;    // 当前页数
        var totalPage = dataJson.total;   // 总页数

        kkpager.generPageHtml({
            //当前页数
            pno: currentPage,
            //总页码
            total: totalPage,
            isGoPage: false,
            mode : 'click',//默认值是link，可选link或者click
            isShowLastPageBtn: false,
            isShowFirstPageBtn: false,
            click : function(n){
                //手动选中按钮
                this.selectPage(n);

                $("html body").animate({scrollTop: $(".main-content").offset().top - 100}, 50);
                $("html").animate({scrollTop: $(".main-content").offset().top - 100}, 50);

                // 加载数据
                requestInterface({"page": n});
                return false;
            }
        }, true);

        // 调整分页组件的位置
        $("#kkpager").show();
        $(".pageBtnWrap").css("margin-left", (($(".pageBtnWrap").parent().width() - $(".pageBtnWrap").width()) / 2) + "px");
    }

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