<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>{{$seoTitle->content}}</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="{{$keyword->content}}">
	<meta name="description" content="{{$search->content}}">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style/css/index.css" rel="stylesheet">
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
						<li><a href="/rom">下载站</a></li>
						<li><a href="/pay">充值</a></li>
						<li><a href="/fuwu">服务</a></li>
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
			<div class="hot-post clearfix">
				
				<div class="layout-left inner-content flickadd" >

					<ul class="flicks">
						<li class="height">
							<div class="font-content">
								<div class="photo"><img src="/images/G1.png" ></div>
							</div>
						</li>
						<li class="height">
							<div class="font-content">
								<div class="photo"><img src="/images/G2.png"></div>
							</div>
						</li>
						<li class="height">
							<div class="font-content">
								<div class="photo"><img src="/images/G3.png"></div>
							</div>
						</li>
					</ul>
				</div>	

				<div class="layout-right">
					<div class="tab clearfix">
						<div class="tab-list active" data-tab="1"><span></span><em>最新主题</em></div>
						<div class="tab-list" data-tab="2"><span></span><em>最新回复</em></div>
						<div class="tab-list" data-tab="3"><span></span><em>热门帖子</em></div>
					</div>

					<div class="content">
						<div class="item">
							<ul data-tab="1">
								@foreach($newList as $val)
									<li><span class="circle"></span><a href="/thread/topic/{{$val->id}}" target="_blank">{{$val->title}}</a></li>
								@endforeach
								<!-- <li><span class="circle"></span><a href="">最新主题模板</a></li>
								<li><span class="circle"></span><a href="">bae可以绑定自己的域名吗？和bch的区别在哪里呢？</a></li>
								<li><span class="circle"></span><a href="">bae可以绑定自己的域名吗？和bch的区别在哪里呢？</a></li>
								<li><span class="circle"></span><a href="">bae可以绑定自己的域名吗？和bch的区别在哪里呢？</a></li>
								<li><span class="circle"></span><a href="">bae可以绑定自己的域名吗？和bch的区别在哪里呢？</a></li> -->
							</ul>

							<ul data-tab="2">
								@foreach($newReply as $val)
									<li><span class="circle"></span><a href="/thread/topic/{{$val->id}}" target="_blank">{{$val->title}}</a></li>
								@endforeach
							</ul>

							<ul data-tab="3">
								@foreach($hotList as $val)
									<li><span class="circle"></span><a href="/thread/topic/{{$val->id}}" target="_blank">{{$val->title}}</a></li>
								@endforeach
							</ul>
						</div>	
					</div>


				</div>
			</div>

			<div class="product clearfix">
				<h2>盒子讨论区</h2>
				<div class="content">
				<?php
				for($i=0;$i<4;$i++) {
				?>
					<a href="/forum/topic/{{$list [$i] ['id']}}" >
						<div class="product-list">
							<div class="first">
								<div class="title">{{$list [$i] ['theme_name']}}</div>
								<div class="pic">
									<img src="https://developer.baidu.com/resources/online/forum/bce/img/sky-ser.png">
								</div>
								<div class="discuss">
									<p>主题: <span>{{$list [$i]['theme_num'] or 0}}</span></p>
									<p>帖子: <span>{{$list [$i]['repley_num'] or 0}}</span></p>
								</div>
							</div>
						</div>
					</a>
				<?php
				}
				?>
				</div>
			</div>

			<div class="classify clearfix">
				<h2>分类讨论区</h2>
				<div class="content clearfix">
					<?php 
					for($i=4;$i<count($list);$i++) {
					?>
					<a href="/forum/topic/{{$list [$i] ['id']}}" target="_blank">
						<div class="classify-list">
							<div class="icon">
								<a href="/forum/topic/{{$list [$i] ['id']}}" target="_blank"><img src="./images/edit.png" alt=""></a>
							</div>
							<div class="info">
								<h4><a href="/forum/topic/{{$list [$i] ['id']}}">{{$list [$i] ['theme_name']}}</a></h4>
								<div class="introduction">
									<p>主题：{{$list [$i]['theme_num'] or 0}}</p>
									<p>帖子：{{$list [$i]['repley_num'] or 0}}</p>
									<p>版主：doujiangyoutiao</p>
								</div>	
							</div>
						</div>
					</a>
					<?php
					}
					?>
					
				</div>
			</div>
		</div>

		<div class="footer">
			<p>Copyright © 2017 - <a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank">粤ICP备17024526号-1</a></p>
		</div>		
	</div>

	<script src="/scripts/lib/jquery/jquery.min.js"></script>
	<script src="/scripts/lib/vue/vue.min.js"></script>
	<script src="/scripts/lib/flickerplate.min.js"></script>
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/index.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	
</body>
</html>



