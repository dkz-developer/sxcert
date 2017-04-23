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
	<div id="app" data-value="<?php echo e(csrf_token()); ?>">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/load"><img src="images/logo_main3.png" alt=""></a>
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
					<form action="" v-show="(isLogin == true)"  data-act="login" id="login">
						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="请输入用户名或者手机号" id="username"  v-on:blur="verification" data-error="用户名不能为空">
							<i class="fa fa-user"></i>
						</div>

						<div class="input-prepend">
							<input  type="password" class="restyle"  placeholder="请输入密码" id="password" v-on:blur="verification" data-error="密码不能为空">
							<i class="fa fa-lock"></i>
						</div>

						<div class="input-prepend">
							<div id="loginForm"></div>
							<p class="wait show">正在加载验证码......</p>
							<p class="notice hide">请先完成验证</p>
						</div>

						<div class="findPassword">
							<a href="/findPassword">忘记密码？</a>
						</div>


						<div class="submitBtn">
							<button type="button" class="btn btn-primary" @click="login">登录</button>
						</div>

					</form>
					<form action="" v-show="(isLogin == false)" data-act="register" id="register" >
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
							
							<div id="registerForm"></div>
							<p class="wait show">正在加载验证码......</p>
							<p class="notice hide">请先完成验证</p>
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
	<script src="http://static.geetest.com/static/tools/gt.js"></script>
	<script src="scripts/public/tools.js"></script>
	<script src="scripts/public/kolDialog.js"></script>
	<script src="scripts/login.js"></script>
</body>
</html>

