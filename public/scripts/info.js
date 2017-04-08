

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
            },            
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

    function showContent(nav,obj) {
        $('#nav_abstract,#nav_comment').removeClass('active');
        $(nav).addClass('active');
        $('.content').hide();
        $(obj).show();
    }
    // 默认事件
    function  bindEvents() {
        // 复制
        var client = new ZeroClipboard($("#copy-button"));
        client.on( "ready", function( eadyEvent) {
            client.on( "aftercopy", function(event) {
                    layer.msg('复制成功 ！',{icon:1,time:3000});
            });
        });        
    }

    $(function() {

        // 默认事件
        bindEvents();

		// 请求接口加载列表数据
	    // requestInterface();

    });

})(jQuery)