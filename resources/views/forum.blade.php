<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>{{$themeInfo->theme_name or ''}} - GSMGOOD - 分享安卓最新鲜最好玩的资源</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="{{$keyword->content}}">
	<meta name="description" content="{{$search->content}}">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/style/css/forum.css" rel="stylesheet">
</head>
<body>

	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/bbs"><img src="/images/logo_main3.png" alt=""></a>
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

		<div class="contain clearfix">
			<div class="breadcrumbs">
			 	<a href="/bbs">论坛首页</a>
				<i class="fa fa-angle-right"></i>
				@if(!empty($themeInfo))<a href="/forum/topic/{{$themeInfo->id}}">{{$themeInfo->theme_name or ''}}</a>@endif
			</div>

			<div class="inner">
				<div class="layout-left">
					<div class="header">
						<div class="logo">
							<img src="/images/topicDefault.png">
						</div>
						<div class="info">
							<h3>{{$themeInfo->theme_name or ''}}</h3>
							<p>版主：doujiangyoutiao</p>
						</div>

						<div class="publishBtn">
							@if(!empty($themeInfo))<a href="/forum/topic/add/{{$themeInfo->id or ''}}">发布主题</a>@endif
						</div>
					</div>
					<div class="content">
						@foreach($list as $val)
							<div class="topic-item">
								<div class="info">
									<a class="title" href="/thread/topic/{{$val->id}}" target="_blank">{{$val->title}}</a>
									@if(1 == $val->is_brilliant)
										<span class="placeTop" style="margin-right: 3px;background-color: #ff6563;border:1px solid #ff6563;border-radius: 3px;">精</span>
									@endif
									@if(1 == $val->is_top)
										<span class="placeTop">置顶</span>
									@endif
									<span class='time'>{{$val->created_at}}</span>
									<span class='user'>{{$val->user_name}}</span>
								</div>
								<div class="view">
									<span>{{$val->view_num or 0}}浏览</span>
									<span>{{$val->reply_num or 0}}回复</span>
								</div>
							</div>
						@endforeach
						<div style="float: right;">
							{{ $list->links() }}
						</div>
						<!-- <div class="topic-item">
							<div class="info">
								<a class="title" href="">bch全新安装wordpress，配置https。进不了后台</a>
								<span class="placeTop">置顶</span>
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
						</div> -->
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
								<a href="/thread/topic/{{$val->id}}">{{$val->title}}</a>
							</li>
						@endforeach
						<!-- 	<li>
								<a href="">域名解析的记录值总是多一个点，导致解析失败</a>
							</li>

							<li>
								<a href="">域名解析的记录值总是多一个点，导致解析失败</a>
							</li>

							<li>
								<a href="">域名解析的记录值总是多一个点，导致解析失败</a>
							</li>

							<li>
								<a href="">域名解析的记录值总是多一个点，导致解析失败</a>
							</li> -->
						</ul>
					</div>
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
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	<script src="/scripts/forum.js"></script>

</body>
</html>



