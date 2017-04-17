

(function($) {

    var keyword = unescape($.mytools.GetQueryString("keyword"));    // 关键字
    var type = $.mytools.GetQueryString("type");   // 登录 注册
    var backURL = $.mytools.getCookie("backURL") ? $.mytools.getCookie("backURL") : document.domain+"/load";


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
        var flag = verification($("#mobile"), "手机号码不能为空") && verification($("#mescode"), "短信验证码不能为空") && verification($("#passWord"), "新密码不能为空") && verification($("#passwordAgain"), "确认密码不能为空") && verification($("#vcode"), "验证码不能为空");

        if(flag) {
            resetBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;密码重置中...');
            var params = {
                "mobile": $("#mobile").val(),
                "mescode": $("#mescode").val(),
                "password": $("#password").val(),
                "repassword": $("#repassword").val(),
                "code": $("#vcode").val(),
                "_token": $("#app").attr("data-value"),
            };

            $.post('/custome/loadlist', params, function(backData) {
                if(backData && backData.code === "S") {
                   window.open(backURL, "_self");
                }else {
                    resetBtn.html("重置密码");
                     layer.msg(backData.msg);
                    $(".vCode-img").find("img").attr("src","/custome/kit/captcha/"+$.mytools.GetRandomNum(10000, 99999));  
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
            $.post("/custome/smsre", params, function(backData) {
                if(backData && backData.code === "S"){
                    clearTimeout(setCountdown);
                    setCountdown($(obj));
                }else{
                    layer.msg(backData.msg);
                    $(".vCode-img").find("img").attr("src","/custome/kit/captcha/"+$.mytools.GetRandomNum(10000, 99999));  

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