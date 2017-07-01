<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>新手专区 -- 论坛页</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="{{$keyword->content}}">
	<meta name="description" content="{{$search->content}}">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/style/css/topic_add.css" rel="stylesheet">
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
				<a href="/forum/topic/{{$themeInfo->id}}">{{$themeInfo->theme_name}}</a>
			</div>

			<div class="inner">
				<div class="layout-left">
					<div class="header">
						<h3>发新主题</h3>
					</div>
					<div class="content">
						<form action="/addArticle" method="post" id="addArticle">
							<div class="row">
								<div class="col-sm-2 propName">主题</div>
								<div class="col-sm-9">
									<input class="form-control" type="text" id="title" placeholder="最多只能输入50个字" name="title">
								</div>
							</div>
							{{ csrf_field() }}
							<div class="row">
								<div class="col-sm-2 propName">正文</div>
								<div class="col-sm-9">
									<script id="pubContent" name="content" type="text/plain"></script>
								</div>
							</div>
							<div class="row" style="min-height: 50px;">
								<div class="col-sm-2 propName"></div>
								<div class="col-sm-2">
									<input type="checkbox" value="1" id="isNeedMoney" name="isNeedMoney">
									<label for="isNeedMoney" style="font-weight: normal;">是否需要金币</label>
								</div>
								<div class="col-sm-7" style="display: none;" id="inputMoney">
									<input type="number" name="money"  class="form-control"  id="money">	
								</div>
							</div>
							<input type="hidden" name="theme" value="{{$themeInfo->id}}">
							<div class="col-sm-11 themePulibBtn">
								<button>发布主题</button>
							</div>
						</form>
					</div>
				</div>

				<div class="layout-right">
					<div class="person-info">
						@if(empty(session('userInfo')))
						@else	
						<p class="names">hi，{{session('userInfo.UserName')}}</p>
						@endif
						<div class="photo">
							<img src="/images/photo.png" alt="">
						</div>

						@if(empty(session('userInfo')))
						<div class="btn-groups">
							<a href="/login" class="login-btn">马上登录</a>
							<a href="/register" class="register-btn">立即注册</a>
						</div>	
						@else
						<div class="info-nums">
							<div class="items">
								<p>{{$articleCount}}</p>
								<h4>主题数</h4>
							</div>
							<div class="seperate"></div>
							<div class="items">
								<p>{{$replyCount}}</p>
								<h4>回复数</h4>
							</div>
						</div>
						@endif
					</div>

					<div class="hot-topics">
						<h3 class="title">热门主题</h3>
						<ul>
							@foreach($hotList as $val)
								<li>
									<a href="">{{$val->title}}</a>
								</li>
							@endforeach
						</ul>
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
	<script src="/scripts/topic_add.js"></script>
</body>
</html>



