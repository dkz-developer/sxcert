<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>下载站 - GSMGOOD - 分享安卓最新鲜最好玩的资源</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="下载站 - GSMGOOD - 分享安卓最新鲜最好玩的资源">
	<meta name="description" content="下载站 - GSMGOOD - 分享安卓最新鲜最好玩的资源">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/style/css/thread.css" rel="stylesheet">
</head>
<body>

	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/rom"><img src="images/logo_main3.png" alt=""></a>
				</div>
				<div class="search">
					<input type="text" placeholder="请输入...">	
					<span class="fa fa-search"></span>
				</div>
				<div class="items clearfix">
					<ul>
						<li><a href="/rom">下载站</a></li>
						<li><a href="/pay">充值</a></li>
						<li><a href="/service">客服</a></li>
						@if(empty(session('userInfo')))
							<li><a href="/login">登录</a></li>
							<li><a href="/register">注册</a></li>
						@else
							<li><a href="/users">{{session('userInfo.UserName')}}</a></li>
							<li><a href='/custome/logout'>退出</a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="breadcrumbs">
			 	<a href="/bbs">论坛首页</a>
				<i class="fa fa-angle-right"></i>
				<a href="/forum/topic/1212">此处需要一个字段</a>
			</div>

			<div class="inner">

				<div class="reply-list">
					<div class="reply-list-item">
						<div class="layout-left">
							<div class="username">华华&周周</div>
							<div class="info">
								<div class="marker">楼主</div>
								<div class="photo">
									<img src="https://developer.baidu.com/resources/online/forum/img/photo.png" >
								</div>

								<div class="info-nums">
									<div class="item">
										<span class="data">12</span>
										<span class="type">主题数</span>
									</div>

									<div class="item">
										<span class="data">1</span>
										<span class="type">回复数</span>
									</div>
								</div>

							</div>
						</div>
						<div class="layout-right">
							
							<div class="header">
								<span class="floor">楼主</span>
								<span class="time">发表于 2016.09.05 15:12:23</span>
								<span class="prev">1556 浏览</span>
								<span class="replys">4 回复</span>
								<span class="goods">1 赞</span>
							</div>

							<div class="content">
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
							</div>

							<div class="bottom">
								<a href=""><i class="fa fa-comment-o"></i> 回复</a>
							</div>

						</div>
					</div>

					<div class="reply-list-item">
						<div class="layout-left">
							<div class="username">华华&周周</div>
							<div class="info">
								<div class="marker">楼主</div>
								<div class="photo">
									<img src="https://developer.baidu.com/resources/online/forum/img/photo.png" >
								</div>

								<div class="info-nums">
									<div class="item">
										<span class="data">12</span>
										<span class="type">主题数</span>
									</div>

									<div class="item">
										<span class="data">1</span>
										<span class="type">回复数</span>
									</div>
								</div>

							</div>
						</div>
						<div class="layout-right">
							
							<div class="header">
								<span class="floor">楼主</span>
								<span class="time">发表于 2016.09.05 15:12:23</span>
								<span class="prev">1556 浏览</span>
								<span class="replys">4 回复</span>
								<span class="goods">1 赞</span>
							</div>

							<div class="content">
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
							</div>

							<div class="bottom">
								<a href=""><i class="fa fa-comment-o"></i> 回复</a>
							</div>

						</div>
					</div>

					<div class="reply-list-item">
						<div class="layout-left">
							<div class="username">华华&周周</div>
							<div class="info">
								<div class="marker">楼主</div>
								<div class="photo">
									<img src="https://developer.baidu.com/resources/online/forum/img/photo.png" >
								</div>

								<div class="info-nums">
									<div class="item">
										<span class="data">12</span>
										<span class="type">主题数</span>
									</div>

									<div class="item">
										<span class="data">1</span>
										<span class="type">回复数</span>
									</div>
								</div>

							</div>
						</div>
						<div class="layout-right">
							
							<div class="header">
								<span class="floor">楼主</span>
								<span class="time">发表于 2016.09.05 15:12:23</span>
								<span class="prev">1556 浏览</span>
								<span class="replys">4 回复</span>
								<span class="goods">1 赞</span>
							</div>

							<div class="content">
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
								<p>版本放啥子？我也不知道</p>
							</div>

							<div class="bottom">
								<a href=""><i class="fa fa-comment-o"></i> 回复</a>
							</div>

						</div>
					</div>
				</div>

				<div class="reply-editor">

					<div class="reply-editor-content">
						<div class="title">回复</div>
						<div class="content">
							<script id="pubContent" name="content" type="text/plain"></script>
						</div>
						<div class="reply-btn">
							<button>回复</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>		
	</div>

	<script src="/scripts/lib/jquery/jquery.min.js"></script>
	<script src="/scripts/lib/UEedtor/ueditor.config.js"></script>
	<script src="/scripts/lib/UEedtor/ueditor.all.min.js"></script>
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	<script src="/style/admin/lib/layer/2.4/layer.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	<script src="/scripts/thread.js"></script>

</body>
</html>



