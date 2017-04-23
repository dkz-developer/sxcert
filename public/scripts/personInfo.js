

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
            resetInfo:resetInfo,
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

    // 修改个人资料
    function resetInfo(event) {

        var resetBtn = $(event.currentTarget);

        // 验证
        var flag = verification($("#username"), "昵称不能为空") && verification($("#mobile"), "手机号码不能为空") ;

        if(flag) {
            resetBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;密码重置中...');
            var params = {
                "username": $("#username").val(),
                "mobile": $("#mobile").val(),
                "password": $("#password").val(),
                "repassword": $("#repassword").val(),
                "_token": $("#app").attr("data-value"),
            };

            $.post('/custome/loadlist', params, function(backData) {
                if(backData && backData.code === "S") {
                    window.location.href = "/rom";
                }else {
                    layer.msg(backData.msg);
                    resetBtn.html("重置密码");
                }

            }, "json");             
        }
    };

    $(function() {


    });

})(jQuery)