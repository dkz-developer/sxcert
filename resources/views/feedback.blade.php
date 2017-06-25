<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>GSMGOOD - 分享安卓最新鲜最好玩的资源</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="{{$keyword->content}}">
	<meta name="description" content="{{$search->content}}">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style/css/feedback.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/rom">GSMGOOD</a>
				</div>

				<div class="btnGroup">
					@if(empty(session('userInfo')))
						<a class="login-btn" href="/login">登录</a>
						<a class="register-btn" href="/register">注册</a>
					@else
						<a href="/users" class="login-btn">{{session('userInfo.UserName')}}</a>
						<a href='/custome/logout' class="register-btn">退出</a>
					@endif
				</div>

				<div class="items">
					<ul>
						<li><a href="/rom">首页</a></li>
						<!-- <li><a href="/">讨论区</a></li> -->
						<li><a href="/pay">充值</a></li>
						<li><a href="/feedback">意见反馈</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="box-container" id="app" data-value="{{ csrf_token() }}">
			<div class="inner">
				<div class="panel panel-default">
					<div class="panel-heading">
						意见反馈
					</div>
					<div class="panel-body">
						<!-- <div class="hot">
							<h3>被顶起来的评论</h3>
							<div class="content">
								<div class="listItem clearfix">
									<div class="photo">
										<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
									</div>
									<div class="info">
										<h4 class="nickname">宣州是爷</h4>
										<p>我总共充了40块钱，就下了一次，150金币的，现在又想下载ROM，怎么又提示我充值呢？ ​​​​</p>
										<div class="bottom">
											<span>2017-03-31</span>
										</div>

									</div>
								</div>
								<div class="listItem clearfix">
									<div class="photo">
										<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
									</div>
									<div class="info">
										<h4 class="nickname">宣州是爷</h4>
										<p>我总共充了40块钱，就下了一次，150金币的，现在又想下载ROM，怎么又提示我充值呢？ ​​​​</p>
										<div class="bottom">
											<span>2017-03-31</span>
										</div>

									</div>
								</div>
								<div class="listItem clearfix">
									<div class="photo">
										<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
									</div>
									<div class="info">
										<h4 class="nickname">宣州是爷</h4>
										<p>我总共充了40块钱，就下了一次，150金币的，现在又想下载ROM，怎么又提示我充值呢？ ​​​​</p>
										<div class="bottom">
											<span>2017-03-31</span>
										</div>

									</div>
								</div>
							</div>
						</div>

						<div class="total">
							<button><em>571</em>条评论</button>
							<div class="options">
								<span class="active">最新</span>
								<span>最早</span>
								<span>最热</span>
							</div>
						</div>
						<div class="total-content">
							<div class="listItem clearfix">
								<div class="photo">
									<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
								</div>
								<div class="info">
									<h4 class="nickname">宣州是爷</h4>
									<p>我总共充了40块钱，就下了一次，150金币的，现在又想下载ROM，怎么又提示我充值呢？ ​​​​</p>
									<div class="bottom">
										<span>2017-03-31</span>
									</div>

								</div>
							</div>

							<div class="listItem clearfix">
								<div class="photo">
									<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
								</div>
								<div class="info">
									<h4 class="nickname">宣州是爷</h4>
									<p>我总共充了40块钱，就下了一次，150金币的，现在又想下载ROM，怎么又提示我充值呢？ ​​​​</p>
									<div class="bottom">
										<span>2017-03-31</span>
									</div>

								</div>
							</div>

							<div class="listItem clearfix">
								<div class="photo">
									<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
								</div>
								<div class="info">
									<h4 class="nickname">宣州是爷</h4>
									<p>我总共充了40块钱，就下了一次，150金币的，现在又想下载ROM，怎么又提示我充值呢？ ​​​​</p>
									<div class="bottom">
										<span>2017-03-31</span>
									</div>

								</div>
							</div>

							<div class="listItem clearfix">
								<div class="photo">
									<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
								</div>
								<div class="info">
									<h4 class="nickname">宣州是爷</h4>
									<p>我总共充了40块钱，就下了一次，150金币的，现在又想下载ROM，怎么又提示我充值呢？ ​​​​</p>
									<div class="bottom">
										<span>2017-03-31</span>
									</div>

								</div>
							</div>

							<div class="listItem clearfix">
								<div class="photo">
									<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
								</div>
								<div class="info">
									<h4 class="nickname">宣州是爷</h4>
									<p>我总共充了40块钱，就下了一次，150金币的，现在又想下载ROM，怎么又提示我充值呢？ ​​​​</p>
									<div class="bottom">
										<span>2017-03-31</span>
									</div>

								</div>
							</div>
						</div> -->
						<!--PC版-->
						<div id="SOHUCS" sid="feedback"></div>
						<script charset="utf-8" type="text/javascript" src="https://changyan.sohu.com/upload/changyan.js" ></script>
						<script type="text/javascript">
							window.changyan.api.config({
							appid: 'cysVLAUAq',
							conf: 'prod_38b26b42c655f8694aaa3a9dd605a250'
							});
						</script>

					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>		
	</div>

	<script src="/scripts/lib/jquery/jquery.min.js"></script>
	<script src="/scripts/lib/vue/vue.min.js"></script>
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/load.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	
</body>
</html>



