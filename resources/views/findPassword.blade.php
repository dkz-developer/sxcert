
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
    <link href="style/css/findPassword.css" rel="stylesheet">
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
			<div class="logo">
				<img src="" alt="">
			</div>

			<div class="main">
				<div class="main-title">
					用手机号重置密码
				</div> 

				<div class="main-content">
					<form action="" data-act="login">
						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="请输入手机号码" id="mobile"  v-on:blur="verification" data-error="短信验证码不能为空">
							<i class="fa fa-mobile"></i>
						</div>

						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="请输入短信验证码" id="mescode"  v-on:blur="verification" data-error="短信验证码不能为空">
							<i class="fa fa-shield"></i>
							<button type="button" class="btn btn-primary sendMessage" @click="sendMessage">发送验证码</button>
						</div>

						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="请输入新密码" id="password"  v-on:blur="verification" data-error="新密码不能为空">
							<i class="fa fa-lock"></i>
						</div>

						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="请再次输入新密码" id="passwordAgain"  v-on:blur="verification" data-error="确认密码不能为空">
							<i class="fa fa-lock"></i>
						</div>
						<div class="input-prepend">
							<input  type="text" placeholder="请输入验证码" class="lastIn" id="vcode" v-on:blur="verification" data-error="验证码不能为空" id="vcode"  v-on:blur="verification" data-error="手机号不能为空">
							<span class="vCode-img"><img @click="refreshVcode" src="http://121.42.147.197/admin/kit/captcha/1" alt=""></span>
						</div>
						<div class="submitBtn">
							<button type="button" class="btn btn-primary" @click="resetPaswrd">重置密码</button>
						</div>

						<div class="back">
							<a href="/enter?type=login"><i class="fa fa-mail-reply"></i> 返回登录注册页</a>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>		
  	</div>

	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?b819a6a70904703dd1926e26ba9554f0";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);

		})();
	</script>
	<script src="scripts/lib/jquery/jquery.min.js"></script>
	<script src="scripts/lib/vue/vue.min.js"></script>
	<script src="/style/admin/lib/layer/2.4/layer.js"></script>
	<script src="scripts/public/tools.js"></script>
	<script src="scripts/findpassword.js"></script>

</body>
</html>
