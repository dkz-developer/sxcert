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
    <link href="style/css/service.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/bbs"><img src="images/logo_main3.png" alt=""></a>
				</div>
				<div class="search">
					<form action="/forum/topic/" id="search">
						<input type="text" placeholder="请输入..." name="keyword">	
						<span class="fa fa-search"></span>
					</form>
				</div>
				<div class="items clearfix">
					<ul>
						<li><a href="/bbs">首页</a></li>
						<li><a href="/rom">下载站</a></li>
						<li><a href="/pay">充值</a></li>
						<li><a href="/service">客服</a></li>
						@if(empty(session('userInfo')))
							<li><a href="/login">登录</a></li>
							<li><a href="/register">注册</a></li>
						@else
							<li><a href="/users?id={{session('userInfo.UserId')}}">{{session('userInfo.UserName')}}</a></li>
							<li><a href='/custome/logout'>退出</a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			
			<div class="help">
				<!-- <h3 class="title"><a href="/">返回论坛主页面</a></h3> -->
				<div class="seperate"></div>
				<div class="services">
					<ul>
						<li>QQ客服：<span>503616983(豆浆油条)</span> <a href="tencent://message/?uin=503616983&Site=&Menu=yes"><img src="images/qq.png" alt=""></a> 处理范围：<em>网站所有大小事情</em></li>
						<li>QQ群：<span>590976628</span> 处理范围：<em>网站用户日常交流（加群时需备注网站用户名）</em></li>
					</ul>
				</div>
			</div>
				
			<div class="contact clearfix">
				<p>客服QQ服务时间 10：00 -- 22：00</p>
				<p class="tips">联系客服前请务必先查看下面的处理范围及常见问题</p>
				<div class="layout-left">
					<h4>客服处理范围</h4>
					<ul>
						<li>1：充值金币问题</li>
						<li>2：百度云链接失效问题</li>
						<li>3：ROM固件文件添加（只提供网站没有列出来的型号以及版本号）</li>
						<li>4：网站访问不了方面</li>
						<li>5：登录注册问题</li>
						<li>6：远程付费有偿解锁服务</li>
					</ul>
				</div>
				<div class="line"></div>
				<div class="laytout-right">
					<h4>常见问题</h4>
					<ul>
						<li>1：<em>本站网址是什么？</em>www.gsmgood.com</li>
						<li>2：<em>充值后多久到账？</em>支付宝付款后一般是1-10分钟到账，超过时间未到账联系客服处理</li>
						<li>3：<em>金币的充值比例是多少？</em>1元=10金币 最低1元起充值</li>
						<li>4：<em>网站提供的固件是官方的吗？</em>纯官方固件 无任何修改不内置任何垃圾软件</li>
						<li>5：<em>联系客服长久未回复？</em>一般都不会不回复 看到都会回复 实在不行可以加好友</li>
						<li>6：<em>购买同一个固件需要重新扣币吗？</em>不需要 只扣一次金币</li>
						<li>7：<em>充值金币支持微信吗？</em>支持 但是需要联系客服扫码充值 最低10起充值</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer">
			<p>Copyright © 2017 - <a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank">粤ICP备17024526号-1</a></p>
		</div>		
	</div>
	<script src="/scripts/lib/jquery/jquery.min.js"></script>
	<script src="/scripts/lib/vue/vue.min.js"></script>
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/service.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	

</body>
</html>
