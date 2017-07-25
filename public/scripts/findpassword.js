

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
            resetPaswrd:resetPaswrd,
            sendMessage:sendMessage,
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

    // 重置密码
    function resetPaswrd(event) {

        var resetBtn = $(event.currentTarget);

        // 验证
        var flag = verification($("#mobile"), "邮箱不能为空") && verification($("#resetcode"), "邮箱验证码不能为空") && verification($("#password"), "新密码不能为空") && verification($("#repassword"), "确认密码不能为空");

        if(flag) {
            resetBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;密码重置中...');
            var params = {
                "mobile": $("#mobile").val(),
                "resetcode": $("#resetcode").val(),
                "password": $("#password").val(),
                "repassword": $("#repassword").val(),
                "_token": $("#app").attr("data-value"),
            };

            $.post('/restpwd', params, function(backData) {
                if(backData && backData.code === "S") {
                   window.location.href = "/login";
                }else {
                    resetBtn.html("重置密码");
                    layer.msg(backData.msg);
                }

            }, "json");             
        }
    };

    // 发送验证码
    function sendMessage(event) {

        var obj = $(event.currentTarget);

        var waitTime = 60;
        function setCountdown(obj) {
            if (waitTime == 0) {
                obj.removeAttr("disabled");
                obj.text("发送验证码");
                waitTime = 60;
            }else {
                obj.attr("disabled", true);
                obj.text("重新发送(" + waitTime + ")");
                waitTime--;
                setTimeout(function() {
                        setCountdown(obj)
                },
                1000)
            }
        }

        var flag = verification($("#mobile"), "邮箱不能为空");

        if(!$.mytools.checkEmail($("#mobile").val())) {
            layer.tips("邮箱格式不正确", $("#mobile"),{tips: [2, '#333'],time: 4000});
            return false;
        }

       var params = {
            "mobile": $("#mobile").val(),
            "_token": $("#app").attr("data-value"),
        };

        if(flag) {
            $.post("/custome/findPassword", params, function(backData) {
                if(backData && backData.code === "S"){
                    clearTimeout(setCountdown);
                    setCountdown($(obj));
                }else{
                    layer.msg(backData.msg);
                }
            }, "json")         
        }
    }

    $(function() {

    });

})(jQuery)