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
    <link href="style/css/pay.css" rel="stylesheet">
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
							<li><a href="/users">{{session('userInfo.UserName')}}</a></li>
							<li><a href='/custome/logout'>退出</a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">

			<div class="main">
				<div class="main-title">充  值</div>

				<div class="main-content">
					<form action="javascript:void(0)" data-act="pay" method="get" id="pays">
						<div class="input-prepend">
							<input class="restyle" id="pay" placeholder="请输入充值金额，最低1元" type="number" id="mobile" v-on:blur="verification" data-error="充值金额不能为空" name="amount">
							<i class="fa fa-rmb"></i>
						</div>

						<div class="alert alert-info">
							支付宝充值：1元=10个金币
						</div>	

						<div class="submitBtn">
							<button type="submit" class="btn btn-info" @click="submit">立即充值</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>		
	</div>
	
	<script src="/scripts/lib/jquery/jquery.min.js"></script>
	<script src="/scripts/lib/vue/vue.min.js"></script>
	<script src="/style/admin/lib/layer/2.4/layer.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#pays').submit(function (){
				var amount = parseInt($('#pay').val());
				if(amount < 1)
					return false;
				var data  = $(this).serialize();
				$.get('/alpay',data,function(data){
					if(data.url)
						window.location.href=data.url;
					else 
						layer.msg(data.msg,{icon:2,time:2000});
				});
			})
			return false;
		});
	</script>
	<!-- <script src="scripts/public/tools.js"></script> -->
	<!-- <script src="scripts/pay.js"></script> -->


</body>
</html>
