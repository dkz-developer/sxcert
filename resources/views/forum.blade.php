<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>新手专业 -- 论坛页</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/style/css/forum.css" rel="stylesheet">
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
				<a href="/forum/topic/1">新手专区</a>
			</div>

			<div class="inner">
				<div class="layout-left">
					<div class="header">
						<div class="logo">
							<img src="https://developer.baidu.com/resources/online/forum/img/forum-platfprm-defalt.png">
						</div>
						<div class="info">
							<h3>新手专区</h3>
							<p>版主：华华&周周</p>
						</div>

						<div class="publishBtn">
							<button>发布主题</button>
						</div>
					</div>
					<div class="content">
						<div class="topic-item">
							<div class="info">
								<a class="title" href="">bch全新安装wordpress，配置https。进不了后台</a>
								<span class='time'>2017年5月4日回帖</span>
								<span class='user'>huahua</span>
							</div>
							<div class="view">
								<span>29浏览</span>
								<span>0回复</span>
							</div>
						</div>

						<div class="topic-item">
							<div class="info">
								<a class="title" href="">bch全新安装wordpress，配置https。进不了后台</a>
								<span class='time'>2017年5月4日回帖</span>
								<span class='user'>huahua</span>
							</div>
							<div class="view">
								<span>29浏览</span>
								<span>0回复</span>
							</div>
						</div>

						<div class="topic-item">
							<div class="info">
								<a class="title" href="">bch全新安装wordpress，配置https。进不了后台</a>
								<span class='time'>2017年5月4日回帖</span>
								<span class='user'>huahua</span>
							</div>
							<div class="view">
								<span>29浏览</span>
								<span>0回复</span>
							</div>
						</div>

						<div class="topic-item">
							<div class="info">
								<a class="title" href="">bch全新安装wordpress，配置https。进不了后台</a>
								<span class='time'>2017年5月4日回帖</span>
								<span class='user'>huahua</span>
							</div>
							<div class="view">
								<span>29浏览</span>
								<span>0回复</span>
							</div>
						</div>

						<div class="topic-item">
							<div class="info">
								<a class="title" href="">bch全新安装wordpress，配置https。进不了后台</a>
								<span class='time'>2017年5月4日回帖</span>
								<span class='user'>huahua</span>
							</div>
							<div class="view">
								<span>29浏览</span>
								<span>0回复</span>
							</div>
						</div>
					</div>
				</div>


				<div class="layout-right"></div>
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
	<script src="/scripts/public/SideTop.js"></script>
	<script src="/scripts/forum.js"></script>

</body>
</html>



