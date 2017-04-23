

(function($) {

    var keyword = unescape($.mytools.GetQueryString("keyword"));    // 关键字
    var type = $.mytools.GetQueryString("type");   // 登录 注册

	// 实例化vue
	var vm = new Vue({
	    el: '#app',
	    data: {
            isLogin: type && type == "login" ? true : false,

	    },
	    methods: {
            verification: function(event) {
                var obj = $(event.currentTarget);
                var errorInfo = obj.attr("data-error");
                verification(obj,errorInfo);
            },
            submit:submit,

	    },
	});

    // 验证
    function verification(obj, errorInfo){
        var val = $(obj).val();
        if(val == null || val == undefined || val == ""){
            layer.tips(errorInfo, $(obj),{tips: [2, '#333'],time: 4000});
            return false;
        }else{
            return true;
        }
    }

    // 充值提交
    function submit(event) {
        // 验证

        var flag = verification($("#pay"), "充值金额不能为空");

        if(flag) {
            submitBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;充值中...');
            var params = {
                "payValue": $("#pay").val(),
                "_token": $("#app").attr("data-value"),
            };

            $.post('/custome/loadlist', params, function(backData) {
                if(backData && backData.code === "S") {

                }else {
                    layer.msg(backData.msg);
                    submitBtn.html("立即充值");
                }

            }, "json");             
        }else {
           
        }
    };

    
    $(function() {


    });

})(jQuery)