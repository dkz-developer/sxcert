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
	<div id="app" data-value="<?php echo e(csrf_token()); ?>">
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
						<?php if(empty(session('userInfo'))): ?>
							<li><a href="/enter?type=login">登录</a></li>
							<li><a href="/enter?type=register">注册</a></li>
						<?php else: ?>
							<li><a href="/users?id=<?php echo e(session('userInfo.UserId')); ?>"><?php echo e(session('userInfo.UserName')); ?></a></li>
							<li><a href='/custome/logout'>退出</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="main">
				<div class="main-title">
					基本资料修改
				</div> 

				<div class="main-content">
					<form action="" data-act="login">
						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="昵称" id="username"  v-on:blur="verification" data-error="昵称不能为空" value="<?php echo e(session('userInfo.UserName')); ?>" disabled>
							<i class="fa fa-user"></i>
						</div>

						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="手机号码" id="mobile"  v-on:blur="verification" data-error="手机号码不能为空" value="<?php echo e(session('userInfo.Mobile')); ?>" disabled>
							<i class="fa fa-mobile"></i>
						</div>

						<div class="input-prepend">
							<input class="restyle" type="text" placeholder="密码（留空则不更改）" id="password"  >
							<i class="fa fa-lock"></i>
						</div>

						<div class="input-prepend">
							<input type="text" class="lastIn"  placeholder="密码确认（留空则不更改）" id="repassword">
							<i class="fa fa-lock"></i>
						</div>
						
						<div class="submitBtn">
							<button type="button" class="btn btn-primary" @click="resetInfo">确认修改</button>
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
	<script src="scripts/public/tools.js"></script>
	<script src="scripts/public/topNav.js"></script>
	<script src="scripts/personInfo.js"></script>

</body>
</html>
