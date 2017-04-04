

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

    // 登录
    function login(event) {

        var loginBtn = $(event.currentTarget);

        // 验证
        var flag = verification($("#userName"), "用户名不能为空") && verification($("#passWord"), "密码不能为空") && verification($("#vcode"), "验证码不能为空");

        if(flag) {
            loginBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;登录中...');
            var params = {
                "userName": $("#userName").val(),
                "passWord": $("#passWord").val(),
                "_token": $("#app").attr("data-value"),
            };

            $.post('/custome/loadlist', params, function(backData) {
                if(backData && backData.code === "S") {
                    window.location.href = "/";
                }else {
                    loginBtn.html("登录");
                }

            }, "json");             
        }
    };

    // 注册
    function register(event) {

        var registerBtn = $(event.currentTarget);
        // 验证
        var flag = verification($("#userName"), "用户名不能为空") && verification($("#mobile"), "手机号不能为空") && verification($("#passWord"), "密码不能为空") && verification($("#passwordAgain"), "确认密码不能为空") && verification($("#vcode"), "验证码不能为空");

        if(flag) {
            registerBtn.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;注册提交中...');
            var params = {
                "userName": $("#userName").val(),
                "mobile": $("#mobile").val(),
                "passWord": $("#passWord").val(),
                "passwordAgain": $("#passwordAgain").val(),
                "_token": $("#app").attr("data-value"),
            };

            $.post('/custome/register', params, function(backData) {

                if(backData && backData.code === "S") {

                }else {
                    registerBtn.html("登录");

                }
            }, "json");             
        }
    };
    
    $(function() {


    });

})(jQuery)