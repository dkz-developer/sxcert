<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>  </title>

	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style/css/login.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/"><img src="images/logo_main3.png" alt=""></a>
				</div>
				<div class="search">
					<input type="text" placeholder="请输入...">	
					<span class="fa fa-search"></span>
				</div>
				<div class="items clearfix">
					<ul>
						<li><a href="/load">下载站</a></li>
						<li><a href="/pay">充值</a></li>
						<li><a href="/service">客服</a></li>
						<li><a href="/enter?type=login">登录</a></li>
						<li><a href="/enter?type=register">注册</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="main">
				<div class="main-title">
					<span :class="{'active' : (isLogin == true)}" data-act="login" @click="nav">登录</span>
					<em></em>
					<span :class="{'active' : (isLogin == false)}" data-act="register" @click="nav">注册</span>
				</div>

				<div class="main-content">
					<form action="" v-if="(isLogin == true)"  data-act="login">
						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="请输入用户名或者手机号" id="username"  v-on:blur="verification" data-error="用户名不能为空">
							<i class="fa fa-user"></i>
						</div>

						<div class="input-prepend">
							<input  type="password" class="restyle" placeholder="请输入密码" id="password" v-on:blur="verification" data-error="密码不能为空">
							<i class="fa fa-lock"></i>
						</div>

						<div class="input-prepend">
							<input  type="text" placeholder="请输入验证码" class="lastIn" id="vcode" v-on:blur="verification" data-error="验证码不能为空">
							<span class="vCode-img"><img :src="vcodeurl" alt="" @click="refreshcode"></span>
						</div>

						<div class="findPassword">
							<a href="/findPassword">忘记密码？</a>
						</div>


						<div class="submitBtn">
							<button type="button" class="btn btn-primary" @click="login">登录</button>
						</div>

					</form>
					<form action="" v-if="(isLogin == false)" data-act="register">
						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="请输入用户名" id="username" v-on:blur="verification" data-error="用户名不能为空">
							<i class="fa fa-user"></i>
						</div>

						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="请输入手机号" id="mobile" v-on:blur="verification" data-error="手机号不能为空">
							<i class="fa fa-mobile"></i>
						</div>

						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="请输入短信验证码" id="mescode"  v-on:blur="verification" data-error="短信验证码不能为空">
							<i class="fa fa-shield"></i>
							<button type="button" class="btn btn-primary sendMessage" @click="sendMessage">发送验证码</button>
						</div>

						<div class="input-prepend">
							<input class="restyle" type="password" placeholder="请输入密码" class="lastIn" id="password" v-on:blur="verification" data-error="密码不能为空">
							<i class="fa fa-lock"></i>
						</div>

						<div class="input-prepend">
							<input class="restyle" type="password" placeholder="请再次输入密码"  id="repassword" v-on:blur="verification" data-error="确认密码不能为空">
							<i class="fa fa-lock"></i>
						</div>

						<div class="input-prepend">
							<!-- <input  type="text" placeholder="请输入验证码" class="lastIn" id="vcode" v-on:blur="verification" data-error="验证码不能为空">
							<span class="vCode-img"><img :src="vcodeurl" alt="" @click="refreshcode"></span> -->
							<div id="embed-captcha"></div>
							<p id="wait" class="show">正在加载验证码......</p>
							<p id="notice" class="hide">请先完成验证</p>
						</div>

						<div class="submitBtn">
							<button type="button" class="btn btn-primary" @click="register">注册</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>		
	</div>
	
	<script src="scripts/lib/jquery/jquery.min.js"></script>
	<script src="scripts/lib/vue/vue.min.js"></script>
	<script src="/style/admin/lib/layer/2.4/layer.js"></script>
	<script src="//static.geetest.com/static/tools/gt.js"></script>
	<script src="scripts/public/tools.js"></script>
	<script src="scripts/public/kolDialog.js"></script>
	<script src="scripts/login.js"></script>
	<script src="http://static.geetest.com/static/tools/gt.js"></script>
	<script>
		var handlerEmbed = function (captchaObj) {
			$("#embed-submit").click(function (e) {
				var validate = captchaObj.getValidate();
				if (!validate) {
					$("#notice")[0].className = "show";
					setTimeout(function () {
						$("#notice")[0].className = "hide";
					}, 2000);
					e.preventDefault();
				}
			});
			// 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
			captchaObj.appendTo("#embed-captcha");
			captchaObj.onReady(function () {
				$("#wait")[0].className = "hide";
			});
			// 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
		};
		$.ajax({
			// 获取id，challenge，success（是否启用failback）
			url: "/gt_start?t=" + (new Date()).getTime(), // 加随机数防止缓存
			type: "get",
			dataType: "json",
			success: function (data) {
				console.log(data);
				// 使用initGeetest接口
				// 参数1：配置参数
				// 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
				initGeetest({
					gt: data.gt,
					challenge: data.challenge,
					new_captcha: data.new_captcha,
					product: "embed", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
					offline: !data.success // 表示用户后台检测极验服务器是否宕机，一般不需要关注
					// 更多配置参数请参见：http://www.geetest.com/install/sections/idx-client-sdk.html#config
				}, handlerEmbed);
			}
		});
	</script>
</body>
</html>
<script>
	initGeetest({
   	// 以下配置参数来自服务端 SDK
   	gt: data.gt,
   	challenge: data.challenge,
   	offline: !data.success,
   	new_captcha: data.new_captcha
}, function (captchaObj) {
   	// 这里可以调用验证实例 captchaObj 的实例方法
})
</script>
