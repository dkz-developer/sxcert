

(function($) {

    var keyword = unescape($.mytools.GetQueryString("keyword"));    // 关键字
    var type = $.mytools.GetQueryString("type");   // 登录 注册
    var backURL = $.mytools.getCookie("backURL") ? $.mytools.getCookie("backURL") : "/load";

	// 实例化vue
	var vm = new Vue({
	    el: '#app',
	    data: {
            isLogin: type && type == "login" ? true : false,
            vcodeurl: "/custome/kit/captcha/"+$.mytools.GetRandomNum(10000, 99999),

	    },
	    methods: {
            // 登录注册切换
            nav: function(event) {
                var type = $(event.currentTarget).attr("data-act");
                vm.isLogin = type == "login" ? true: false;
            }, 
            verification: function(event) {
                var obj = $(event.currentTarget);
                var errorInfo = obj.attr("data-error");
                verification(obj,errorInfo);
            },
            login: login,
            register: register,
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

        var flag = verification($("#mobile"), "手机号不能为空") && verification($("#vcode"), "验证码不能为空");


       var params = {
            "mobile": $("#mobile").val(),
            "code": $("#vcode").val(),
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

    // 登录
    function login(event) {
        var loginBtn = $(event.currentTarget);

        if(loginBtn.hasClass("disabled")) return false;

        // 验证
        var flag = verification($("#username"), "用户名不能为空") && verification($("#password"), "密码不能为空");

        if(flag) {
            loginBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;登录中...');
            var params = {
                "username": $("#username").val(),
                "password": $("#password").val(),
                "geetest_challenge": vm.login_geetest_challenge,
                "geetest_validate": vm.login_geetest_validate,
                "geetest_seccode": vm.login_geetest_seccode,
                "_token": $("#app").attr("data-value"),
            };

            $.post('/custome/login', params, function(backData) {
                if(backData && backData.code === "S") {
                    window.open(backURL, "_self");
                }else {
                   layer.msg(backData.msg);
                    loginBtn.html("登录");
                }

            }, "json");             
        }
    };

    // 注册
    function register(event) {

        var registerBtn = $(event.currentTarget);

        if(registerBtn.hasClass("disabled")) return false;
        
        // 验证
        var flag = verification($("#username"), "用户名不能为空") && verification($("#mobile"), "手机号不能为空") && verification($("#mescode"), "短信验证码不能为空") && verification($("#password"), "密码不能为空") && verification($("#repassword"), "确认密码不能为空");

        if(flag) {
            registerBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;注册提交中...');
            var params = {
                "username": $("#username").val(),
                "mobile": $("#mobile").val(),
                "password": $("#password").val(),
                "repassword": $("#repassword").val(),
                "mescode": $("#mescode").val(),
                "geetest_challenge": vm.register_geetest_challenge,
                "geetest_validate": vm.register_geetest_validate,
                "geetest_seccode": vm.register_geetest_seccode,
                "_token": $("#app").attr("data-value"),
            };

            $.post('/custome/register', params, function(backData) {

                if(backData && backData.code === "S") {
                    window.open(backURL, "_self");
                }else {
                   layer.msg(backData.msg);
                    registerBtn.html("注册");
                }
            }, "json");             
        }
    };

    // 级验验证
    function vCode(obj) {

        $(obj).parents("form").find("button").addClass("disabled");

        var handlerEmbed = function (captchaObj) {

            captchaObj.appendTo(obj);

            captchaObj.onReady(function () {

                $(obj).siblings(".wait")[0].className = "hide";

            });

             captchaObj.onSuccess(function() {

                $(obj).parents("form").find("button").removeClass("disabled");

                 var result = captchaObj.getValidate();

                 if(obj == "#loginForm") {
                    vm.login_geetest_challenge = result.geetest_challenge;
                    vm.login_geetest_validate = result.geetest_validate;
                    vm.login_geetest_seccode = result.geetest_seccode;
                 }else {
                    vm.register_geetest_challenge = result.geetest_challenge;
                    vm.register_geetest_validate = result.geetest_validate;
                    vm.register_geetest_seccode = result.geetest_seccode;
                 }

             });
        };
        
        $.get("/gt_start?t=" + (new Date()).getTime(), {}, function(data) {
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                new_captcha: data.new_captcha,
                product: "embed", 
                offline: !data.success 
                
            }, handlerEmbed);

        }, "json");     
    }

    
    $(function() {

        vCode("#loginForm");
        vCode("#registerForm");
    });

})(jQuery)