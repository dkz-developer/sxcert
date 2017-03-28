/**
 * 用户登录JS
 * @authors SX
 * @date    2015-09-17 17:24:46
 */

/*function Login(){}
var login = new Login();*/

define(['jquery',"tools"], function($,tools){

	// 取得登录框代码
	function getLoginCode(){

		var __login_code = "";

		var winH = $(window).height();
		var winW = $(document).width();

		var w = 969;
		var h = 432;

		var style = "top:"+(((winH - h) / 2) + $(window).scrollTop())+"px;left:"+((winW - w) / 2)+"px";


		__login_code = '';
		__login_code += '<div class="login-cover" style="height:'+$(document).height()+'px;"></div>';
		__login_code += '<div class="login-container" style="'+style+'">';
		__login_code += '	<div class="login-title">';
		__login_code += '		<h2><img src="images/login/login_icon.png"> 登录</h2>';
		__login_code += '		<div class="login-tab-option">';
		__login_code += '			<a class="loginType active" data-val="company" href="javascript:void(0)">广告主登录</a>';
		__login_code += '			<a class="loginType " data-val="kol" href="javascript:void(0)">自媒体登录</a>';
		__login_code += '		</div>';
		__login_code += '		<a class="login-close-btn" href="javascript:void(0)">X</a>';
		__login_code += '	</div>';
		__login_code += '	<div class="login-content">';
		__login_code += '		<div class="login-photo"><img src="images/login/login_bg_img.png" alt=""></div>';
		__login_code += '		<div class="login-form">';
		__login_code += '			<div class="row">';
		__login_code += '				<label for="userName">用户名</label>';
		__login_code += '				<input type="text" id="userName">';
		__login_code += '			</div>';
		__login_code += '			<div class="row">';
		__login_code += '				<label for="password">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>';
		__login_code += '				<input type="password" id="passWord">';
		__login_code += '			</div>';
		__login_code += '			<div class="row">';
		__login_code += '				<label for="vcode">验证码</label>';
		__login_code += '				<input id="vcode" maxlength="4">';
		__login_code += '				<a href="javascript:void(0)" id="refreshVcodeBtn" class="btn btn-link"><span class="verificationCode-img"><img src="/vcode?_='+$.mytools.GetRandomNum(10000, 99999)+'" alt="验证码" /></span></a>';
		__login_code += '			</div>';
		__login_code += '			<a class="registered-btn" id="registerBtn" href="javascript:void(0)">还没有帐号? 快速注册!</a>';
		__login_code += '			<button class="login-btn" id="loginBtn" type="button">登&nbsp;&nbsp;录</button>';

		__login_code += '			<a class="findPassword-btn" id="findPasswordBtn" href="javascript:void(0);">忘记密码?</a>';
		__login_code += '			<div class="error-info"><span></span><em></em></div>';
		__login_code += '		</div>';
		__login_code += '	</div>';
		__login_code += '</div>';

		return __login_code;
	}

	// 取得登录框样式
	function getLoginStyle(){
		var __login_style = [];
		__login_style.push('.login-cover{position: absolute; top: 0; left: 0; background: rgba(0, 0, 0, .4); min-width: 1200px; width: 100%; height: 900px; z-index: 9998;}');
		__login_style.push('.login-container{position: absolute; width: 969px; height: 432px; border-radius: 4px; background: #fff; z-index: 9999;}');
		__login_style.push('.login-container .login-title{position: relative; height: 73px; line-height: 73px; border-bottom: 2px #f2f2f2 solid; overflow: hidden;}');
		__login_style.push('.login-container .login-title h2{float:left; padding-left: 20px; width: 500px; height: 73px; line-height: 85px; color: #36adcb; font-size: 20px;}');
		__login_style.push('.login-container .login-title img{vertical-align: middle; margin-top: -10px; margint-rigit: 5px;}');
		__login_style.push('.login-container .login-title .login-close-btn{position: absolute; right: 10px; display: inline-block; width: 20px; height: 20px; color: #ccc; font-size: 18px; line-height: 25px; top: 10px;}');
		__login_style.push('.login-container .login-tab-option{float: left; margin-left: 20px;}');
		__login_style.push('.login-container .login-tab-option a{display: inline-block; padding: 0 25px; margin-right: 10px; height: 71px; line-height: 85px; border-bottom: 2px transparent solid; font-size: 20px; color: #666;}');
		__login_style.push('.login-container .login-tab-option a.active{border-bottom-color: #36adcb; color: #36adcb;}');
		__login_style.push('.login-container .login-content:before, .login-container .login-content:after{content: ""; display: table; }');
		__login_style.push('.login-container .login-content:after{clear: both;}');
		__login_style.push('.login-container .login-content .login-photo{float: left; width: 500px; text-align: center; padding-top: 40px;}');
		__login_style.push('.login-container .login-content .login-form{float: left; width: 300px; padding: 40px 40px 0 40px;box-sizing: content-box;}');
		__login_style.push('.login-container .login-content .login-form .row {height: 45px; line-height: 45px; margin: 0; }');
		__login_style.push('.login-container .login-content .login-form .row label { display: inline-block; width: 60px; padding-right: 5px; text-align: right; }');
		__login_style.push('.login-container .login-content .login-form .row input { height: 30px; width: 200px; line-height: 30px; padding: 0 5px; border-radius: 2px; border: 1px #e0e0e0 solid; }');
		__login_style.push('.login-container .login-content .login-form .row input:focus { border-color: #44c0e1; }');
		__login_style.push('.login-container .login-content .login-form .row input#vcode { width: 100px; }');
		__login_style.push('.login-container .login-content .login-form .row .verificationCode-img img{margin-left: 10px; width: 85px;}');
		__login_style.push('.login-container .login-content .login-form .registered-btn { display: block; text-align: center; height: 40px; line-height: 40px; color: #44c0e1; }');
		__login_style.push('.login-container .login-content .login-form .login-btn { display: block; margin: 0 auto; width: 90%; height: 35px; border: 0; background: #44c0e1; border-radius: 4px; font-size: 16px; color: #fff; }');
		__login_style.push('.login-container .login-content .login-form .login-btn:hover { background: #33adcd; }');
		__login_style.push('.login-container .login-content .login-form .findPassword-btn { display: block; text-align: center; height: 50px; line-height: 50px; color: #ccc; }');
		__login_style.push('.login-container .login-content .login-form .error-info {text-align: center; color: red;}');
		__login_style.push('.login-container .login-content .login-form .error-info em{font-style: normal;}');


		return __login_style.join(" ");
	}


	var Login = {

		_init: function(loginType, jumpUrl) {
			// 如果页面中已有登录框则不再弹出
			if($(".login-container").size() > 0){return false;}

			var pluginDefaults = {
				"_login_code": getLoginCode(),
				"_login_style": getLoginStyle()
			};

			this.options = pluginDefaults;
			this.loginType = loginType;
			this.jumpUrl = jumpUrl;

			// 向页面写入样式
			if($("head").find("#loginStyle").size() <= 0){
				$("head").append('<style id="loginStyle">'+this.options._login_style+'</style>');
			}
			this._show();
		},

		_show: function() {
			$("body").prepend(this.options._login_code);

			// 绑定相关事件
			this._bindEvent($(".login-container"));
		},

		_bindEvent: function(_login_dialog) {
			var _that = this;

			var userName = _login_dialog.find("#userName");	// 用户名
			var passWord = _login_dialog.find("#passWord");	// 密码
			var verificationCode = _login_dialog.find("#vcode");	// 验证码

			userName.focus();

			// 关闭登录框
			$(".login-close-btn").click(function() {
				$(".login-cover").remove();
				_login_dialog.remove();

				// 广告主和自媒体页面关闭登录框 跳回首页
				var url = window.location.href;
				if(url.indexOf("/company/") > 0 || url.indexOf("/kol/") > 0) {
					window.location.href = "/";
				}
			});

			// 选择登录类型交互效果
			loginTypeEvent(_login_dialog, _that.loginType);

			// 输入项验证
			userName.blur(function() {
				verification($(this), "用户名不能为空");
			});

			passWord.blur(function() {
				verification($(this), "密码不能为空");
			});

			verificationCode.blur(function() {
				verification($(this), "验证码不能为空");
			});

			// 验证码刷新
			function reVcode() {
				$(".verificationCode-img").empty().append('<i class="fa fa-spinner fa-pulse"></i>');
				var vcode_img = $('<img id="vcode-img" src="/vcode?_='+$.mytools.GetRandomNum(10000, 99999)+'" alt="验证码" />');
				vcode_img.load(function() {
					if($(".verificationCode-img").find("#vcode-img").size() <= 0){
						$(".verificationCode-img").empty().append(vcode_img);
					}
				});
			}

			// 刷新验证码
			var refreshVcode = $("#refreshVcodeBtn");
			refreshVcode.click(function(){
				reVcode();
			});

			//注册按钮
			var registerBtn = $("#registerBtn");
			registerBtn.click(function() {
				var type = $(".loginType.active").attr("data-val");
				window.location.href = "/register.php?type="+type;
			});

			//找回密码按钮
			var findPasswordBtn = $("#findPasswordBtn");
			findPasswordBtn.click(function() {
				var type = $(".loginType.active").attr("data-val");
				window.location.href = "/findPassword_fir.php?type="+type;
			});

			// 提交按钮
			var loginBtn = _login_dialog.find("#loginBtn");
			loginBtn.click(function(){
				var _self = $(this);
				login(_self, _that);
			});

			$("#userName, #passWord ,#vcode").keydown(function(event) {
				if(event.keyCode === 13){
					login(loginBtn, _that);
				}
			});

			function login(loginBtn, loginObj){

				var loginType = _login_dialog.find(".loginType.active");	// 用户名
				// 验证
				var flag = verification($(userName), "用户名不能为空") && verification($(passWord), "密码不能为空") && verification($(verificationCode), "验证码不能为空");

				if(flag){
					loginBtn.addClass("buttonLoading").html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;登录中...');
					_login_dialog.find("fieldset").attr("disabled", true);
					var params = {
						"act": loginType.attr("data-val"),
						"userName": userName.val(),
						"passWord": passWord.val(),
						"vcode": verificationCode.val(),
						"autoLogin": "0",
						"_token": $("#app").attr("data-value") // 拉瓦框架登录所需额外参数
					};

					$.post("/login", params, function(backData) {
						if(backData && backData.code === "S"){
							if(loginType.attr("data-val") === "company"){
								window.location.href = loginObj.jumpUrl ? loginObj.jumpUrl : $.mytools.rankRequestUrl+"/company/choose_opinionLeaders.php?olt=weixin";
							}else if(loginType.attr("data-val") === "kol"){
								window.location.href = loginObj.jumpUrl ? loginObj.jumpUrl : $.mytools.rankRequestUrl+"/kol";
							}
						}else{
							$(".login-container").find(".error-info > span").slideDown(300);
							$(".login-container").find(".error-info").find("em").text(backData.msg);
							loginBtn.removeClass("buttonLoading").html('登录');
							_login_dialog.find("fieldset").removeAttr("disabled");
							reVcode();
						}
					}, "json");
				}
			}

			function verification(obj, errorInfo){
				var val = $(obj).val();
				if(val == null || val == undefined || val == ""){
					$(obj).parent().addClass("input-error");
					$(".login-container").find(".error-info > span").slideDown(300);

					$(".login-container").find(".error-info").find("em").text(errorInfo);
					return false;
				}else{
					$(obj).parent().removeClass("input-error");
					$(".login-container").find(".error-info > span").slideUp("slow");
					$(".login-container").find(".error-info").find("em").text("");
					return true;
				}
			}

			// 选择登录类型交互效果
			function loginTypeEvent(_login_dialog, loginTypeVal){
				var loginType_btn = _login_dialog.find(".login-tab-option").find("a");

				loginType_btn.removeClass("active");
				_login_dialog.find(".login-tab-option").find("a[data-val='"+loginTypeVal+"']").addClass("active");

				loginType_btn.click(function(){
					loginType_btn.removeClass("active");
					$(this).addClass("active");
				});
			}
		}

	}

	return Login;

});