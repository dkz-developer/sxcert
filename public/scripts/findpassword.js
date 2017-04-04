

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
            refreshVcode:refreshVcode,

	    },
	});


    // 验证
    function verification(obj, errorInfo){
        var val = $(obj).val();
        if(val == null || val == undefined || val == ""){
            $(".main-content").find(".error-info > span").slideDown(300);
            $(".main-content").find(".error-info").find("span").text(errorInfo);
            return false;
        }else{
            $(".main-content").find(".error-info > span").slideUp("slow");
            $(".main-content").find(".error-info").find("span").text("");
            return true;
        }
    }

    // 重置密码
    function resetPaswrd(event) {

        var resetBtn = $(event.currentTarget);

        // 验证
        var flag = verification($("#mobile"), "手机号码不能为空") && verification($("#mescode"), "短信验证码不能为空") && verification($("#passWord"), "新密码不能为空") && verification($("#passwordAgain"), "确认密码不能为空") && verification($("#vcode"), "验证码不能为空");

        if(flag) {
            resetBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;密码重置中...');
            var params = {
                "userName": $("#userName").val(),
                "passWord": $("#passWord").val(),
                "_token": $("#app").attr("data-value"),
            };

            $.post('/custome/loadlist', params, function(backData) {
                if(backData && backData.code === "S") {
                    window.location.href = "/";
                }else {
                    resetBtn.html("重置密码");
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

        var flag = verification($("#mobile"), "手机号码不能为空");
       var params = {
            "mobile": $("#mobile").val(),
            "_token": $("#app").attr("data-value"),
        };

        if(flag) {
            $.post("", params, function(backData) {
                if(backData && backData.code === "S"){
                    $(".main-content").find(".error-info > span").slideUp("slow");
                    $(".main-content").find(".error-info").find("span").text("");
                    clearTimeout(setCountdown);
                    setCountdown($(obj));
                }else{
                    $(".main-content").find(".error-info > span").slideDown(300);
                    $(".main-content").find(".error-info").find("span").text(backData.msg);
                }
            }, "json")           
        }
    }

    // 刷新验证码
    function refreshVcode(event) {
         var obj = $(event.currentTarget);
         obj.attr("src","/http://121.42.147.197/admin/kit/captcha/1");
    }

    
    $(function() {


    });

})(jQuery)