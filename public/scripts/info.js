

(function($) {

    var id = location.pathname.split("/")[2]; //  资料ID



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
            load:load,         
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

    // 评论
    function message() {
        $('#info-comment').submit(function(){
            var param = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#app').attr('data-value')
                },
                type: 'POST',
                url: '/add/InfoComment',
                dataType: 'json',
                data: param,
                success: function(result){
                    if(result.code='S'){
                        var html = '<div class="content-discussion clearfix">';
                        html += '<div class="photo">';
                        html += '<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">'
                        html += '</div>';
                        html += '<div class="discussion-info">';
                        html += '<h4 class="nickname">'+result.data.user_name+'</h4>';
                        html += '<p>'+result.data.content+'</p>';
                        html += '<div class="left">';
                        html += '<span>'+result.data.created_at+'</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        $('.mesBoard').before(html);
                        $("#message").val("");
                    }else {
                        layer.msg(result.msg,{icon:2,time:2000});
                    }
                } 
            });
            return false;
        });      
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

        // 微博KBI指数说明
        var tipsContent = [];
        tipsContent.push('<div class="tips" style="text-align: center;">');
        tipsContent.push(' <p>请复制黄色区中的下载密码</p>');
        tipsContent.push('</div>');
        $(".loadBtn a").webuiPopover({
            content: tipsContent.join(""),
            trigger: 'hover',
            placement: 'top',
            style:'inverse',
            width: 170,
            padding: false
        });

    }

    function load() {

        var params = {
            "info_id": id,
             "_token": $("#app").attr("data-value")
        };

        var newWin = window.open('about:blank');

        $.post('/buyInfo', params, function(backData) {

            if(backData && backData.code === "S") {

                newWin.location.href = backData.url;

            }else {

                if(backData && backData.msg !== "") {
                    layer.alert(backData.msg,{icon:2,time:3000});
                }

                if(backData && backData.url) {
                     window.location.href = backData.url;
                }
            }

        }, "json"); 
    }

    $(function() {

        // 默认事件
        bindEvents();

        message();

		// 请求接口加载列表数据
	    // requestInterface();

    });

})(jQuery)