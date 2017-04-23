

(function($) {

    var keyword = unescape($.mytools.GetQueryString("keyword"));    // 关键字
    var backURL = $.mytools.getCookie("backURL") ? $.mytools.getCookie("backURL") : "/load";
    var type = location.pathname.split("/")[1]; // 登录 注册

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

        var flag = verification($("#mobile"), "手机号不能为空");

        if(!$.mytools.checkMobile($("#mobile").val())) {
            layer.tips("手机号码格式不正确", $("#mobile"),{tips: [2, '#333'],time: 4000});
            return false;
        }
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

    // 登录
    function login(event) {
        var loginBtn = $(event.currentTarget);

        if(loginBtn.hasClass("disabled")) return false;

        // 验证
        var flag = verification($("#login").find("#username"), "用户名不能为空") && verification($("#login").find("#password"), "密码不能为空");

        if(flag) {
            loginBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;登录中...');
            var params = {
                "username": $("#login").find("#username").val(),
                "password": $("#login").find("#password").val(),
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
                    vm.login_captchaObj.reset();
                }

            }, "json");             
        }
    };

    // 注册
    function register(event) {

        var registerBtn = $(event.currentTarget);

        if(registerBtn.hasClass("disabled")) return false;
        
        // 验证
        var flag = verification($("#register").find("#username"), "用户名不能为空") && verification($("#register").find("#mobile"), "手机号不能为空") && verification($("#register").find("#mescode"), "短信验证码不能为空") && verification($("#register").find("#password"), "密码不能为空") && verification($("#register").find("#repassword"), "确认密码不能为空");

        if(flag) {
            registerBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;注册提交中...');
            var params = {
                "username": $("#register").find("#username").val(),
                "mobile": $("#register").find("#mobile").val(),
                "password": $("#register").find("#password").val(),
                "repassword": $("#register").find("#repassword").val(),
                "mescode": $("#register").find("#mescode").val(),
                "geetest_challenge": vm.register_geetest_challenge,
                "geetest_validate": vm.register_geetest_validate,
                "geetest_seccode": vm.register_geetest_seccode,
                "_token": $("#app").attr("data-value"),
            };

            $.post('/custome/register', params, function(backData) {

                if(backData && backData.code === "S") {
                    window.location.href = "/enter?type=login";
                }else {
                   layer.msg(backData.msg);
                    registerBtn.html("注册");
                    vm.register_captchaObj.reset();
                    
                }
            }, "json");             
        }
    };

    // 级验验证
    function vCode(obj) {

        $(obj).parents("form").find(".submitBtn button").addClass("disabled");

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

                    vm.login_captchaObj = captchaObj;
                 }else {
                    vm.register_geetest_challenge = result.geetest_challenge;
                    vm.register_geetest_validate = result.geetest_validate;
                    vm.register_geetest_seccode = result.geetest_seccode;

                    vm.register_captchaObj = captchaObj;
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