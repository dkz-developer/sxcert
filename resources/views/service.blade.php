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
					<a href="/rom"><img src="images/logo_main3.png" alt=""></a>
				</div>
				<div class="search">
					<form action="/forum/topic/" id="search">
						<input type="text" placeholder="请输入..." name="keyword">	
						<span class="fa fa-search"></span>
					</form>
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
				<p>刷机客服工作时间段： 9：00 -- 22：00</p>
				<div class="seperate"></div>
				<div class="services">
					<ul>
						<li>客服一：<span>503616985</span> <a href="tencent://message/?uin=客服一：503616985&Site=&Menu=yes"><img src="images/qq.png" alt=""></a> 处理范围：<em>三星刷机</em></li>
						<li>客服二：<span>503616985</span> <a href="tencent://message/?uin=客服一：503616985&Site=&Menu=yes"><img src="images/qq.png" alt=""></a> 处理范围：<em>三星刷机</em></li>
						<li>客服三：<span>503616985</span> <a href="tencent://message/?uin=客服一：503616985&Site=&Menu=yes"><img src="images/qq.png" alt=""></a> 处理范围：<em>三星刷机</em></li>
						<li>客服四：<span>503616985</span> <a href="tencent://message/?uin=客服一：503616985&Site=&Menu=yes"><img src="images/qq.png" alt=""></a> 处理范围：<em>三星刷机</em></li>
					</ul>
				</div>
			</div>
				
			<div class="contact clearfix">
				<p>客服QQ：123456789 （工作时间段：10：00 -- 22：00）</p>
				<p class="tips">请务必先查看下面的处理范围及常见问题</p>
				<div class="layout-left">
					<h4>客服处理范围</h4>
					<ul>
						<li>1：充值及退款问题。</li>
						<li>2：ROM文件添加（请自行先确认您要添加的固件或型号在本站型号列表有收录）</li>
						<li>3：网站故障方面。</li>
						<li>4：不提供手机故障处理，远程刷机等一切非下载问题。</li>
					</ul>
				</div>
				<div class="line"></div>
				<div class="laytout-right">
					<h4>常见问题</h4>
					<ul>
						<li>1：<em>解压密码是多少？</em>在文件购买页面有明显注明，请自行查看，不必添加QQ。</li>
						<li>2：<em>付款后多久到账？</em>在支付宝或QQ付款，只要付款时有填写备注，10分内到账，期间请多次刷新网页查看流量是否到账，长时间未到才联系。</li>
						<li>3：<em>如果是支付宝或QQ付款未填写备注用户UID？</em>添加客服后，联系时请提供您的支付宝账号或者QQ账号和用户UID。</li>
					</ul>
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
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/service.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	

</body>
</html>
