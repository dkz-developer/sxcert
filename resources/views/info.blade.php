<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<!-- <title> {{$info->brand}}-{{$info->country}}-{{$info->model}}-{{$info->version}}-{{$info->os}}-GSMGOOD</title> -->
	<title><?php $brand = explode('/',$info->brand);echo trim($brand [0]);?>-<?php $country = explode('/',$info->country);echo $country [1];?>-{{$info->model}}-{{$info->version}}-{{$info->os}}-GSMGOOD</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="style/css/info.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/">GSMGOOD</a>
				</div>

				<div class="btnGroup">
					<a class="login-btn" href="/enter?type=login">登录</a>
					<a class="register-btn" href="/enter?type=register">注册</a>
				</div>

				<div class="items">
					<ul>
						<li><a href="/load">首页</a></li>
						<li><a href="/">讨论区</a></li>
						<li><a href="/pay">充值</a></li>
						<li><a href="/feedback">意见反馈</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="box-container" id="app" data-value="{{ csrf_token() }}">
			<div class="account-info clearfix panel panel-default">
				<div class="layoutLeft well well-sm">
					{{$info->model}}
				</div>

				<div class="layoutRight">
					<h4 class="title">
						<?php $brand = explode('/',$info->brand);echo trim($brand [0]);?>/<?php $country = explode('/',$info->country);echo $country [1];?>/{{$info->model}}/{{$info->version}}<em>{{$info->os}}</em>
					</h4>

					<div class="public">
						<span>上传者：<a href="/users">管理员</a></span>
						<span>点击量：{{$info->view_num}}</span>
						<span>下载量：{{$info->download_num}}</span>
					</div>

					<div class="info well well-sm clearfix">
						<div class="left">
							<ul>
								<li>品牌：<a href=""><?php $brand = explode('/',$info->brand);echo $brand [0];?></a></li>
								<li>区域/国家：<a href=""><?php $country = explode('/',$info->country);echo $country [0];?></a></li>
								<li>型号：<a href="">{{$info->model}}</a></li>
								<li>版本号码：<a href="">{{$info->version}}</a></li> 
								<li>系统版本：<a href="">{{$info->os}}</a></li>
								<li>更新时间：{{date('Y-m-d',strtotime($info->updated_at))}}</li>
							</ul>
						</div>
						<div class="right">
							<div class="money"><em>{{number_format($info->price,2)}}</em>金币</div>
							<div class="password alert alert-warning" id="copy-button" data-clipboard-text="{{$info->download_password}}">密码: {{$info->download_password}} </div>
							<div class="loadBtn">
								<a class="btn btn-info" href="">立即下载</a>
							</div>
						</div>
					</div>	
				</div>
			</div>

			<div class="main-info panel panel-default panel-notice">

				<div class="panel-heading panel-tabs">
					<ul class="nav nav-tabs">
					 	<li class="active" id="nav_comment"><a href="javascript:void(0);" onclick="showContent('#nav_comment','#comment')">评论</a></li>
						<li id="nav_abstract"><a href="javascript:void(0);" onclick="showContent('#nav_abstract','#abstract')">介绍</a></li>
					</ul>
				</div>
				
				<div class="content" id="comment">
					<div class="info-comment" style="width: 100%;height: 150px;padding-top: 20px;">
						<div class="face-ico" style="width: 10%;height: 50px;float: left;margin:0 10px 0 20px;text-align: right;">
							<img src="http://static.duoshuo.com/images/noavatar_default.png" style="width: 50px;height: 100%;border-radius: 3px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.22);">	
						</div>
						<div class="info-con" style="float: left;width: 80%;background: #fff url('//static.duoshuo.com/images/bg_sprites.png') repeat-x scroll 0 -90px;border-color: #ccc #ccc currentcolor;border-style: solid solid none;border-width: 1px 1px medium;border-top-left-radius: 3px; border-top-right-radius: 3px;">
							<textarea name="content" style="background: rgba(0, 0, 0, 0);height: 70px;color: #999;border: medium none;width: 100%;resize:none;padding: 5px;"placeholder="说点什么吧..."></textarea>
							<div style="width: 100%;border: 1px solid #ccc;border-left:none;border-right:none;text-align:right;height: 30px;border-bottom-left-radius: 3px;border-bottom-right-radius: 3px;background: rgba(0, 0, 0, 0) url('//static.duoshuo.com/images/bg_sprites.png') repeat-x scroll 0 -60px;">
								<button type="submit" style="height: 100%;border:none; width: 100px;text-align: center;border-left:1px solid #ccc;">发布</button>
							</div>
						</div>
					</div>	
					<div class="content-discussion clearfix">
						<div class="photo">
							<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
						</div>
						<div class="discussion-info">
							<h4 class="nickname">宣州是爷</h4>
							<p>我在物质上的最高奢望就是，在一个和平的世界上，有一个健康的身体，过一种小康的日子。—— by 邓云华 ​​​​</p>
							<div class="opts">
								<span>2015年2月4日</span>
								<span><i class="fa fa-reply"></i>回复</span>
							</div>
						</div>
					</div>

					<div class="content-discussion clearfix">
						<div class="photo">
							<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
						</div>
						<div class="discussion-info">
							<h4 class="nickname">宣州是爷</h4>
							<p>我在物质上的最高奢望就是，在一个和平的世界上，有一个健康的身体，过一种小康的日子。—— by 邓云华 ​​​​</p>
							<div class="left">2017-03-31</div>
						</div>
					</div>

					<div class="content-discussion clearfix">
						<div class="photo">
							<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
						</div>
						<div class="discussion-info">
							<h4 class="nickname">宣州是爷</h4>
							<p>我在物质上的最高奢望就是，在一个和平的世界上，有一个健康的身体，过一种小康的日子。—— by 邓云华 ​​​​</p>
							<div class="left">2017-03-31</div>
						</div>
					</div>

					<div class="content-discussion clearfix">
						<div class="photo">
							<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
						</div>
						<div class="discussion-info">
							<h4 class="nickname">宣州是爷</h4>
							<p>我在物质上的最高奢望就是，在一个和平的世界上，有一个健康的身体，过一种小康的日子。—— by 邓云华 ​​​​</p>
							<div class="left">2017-03-31</div>
						</div>
					</div>

					<div class="content-discussion clearfix">
						<div class="photo">
							<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
						</div>
						<div class="discussion-info">
							<h4 class="nickname">宣州是爷</h4>
							<p>我在物质上的最高奢望就是，在一个和平的世界上，有一个健康的身体，过一种小康的日子。—— by 邓云华 ​​​​</p>
							<div class="left">2017-03-31</div>
						</div>
					</div>

					<div class="content-discussion clearfix">
						<div class="photo">
							<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
						</div>
						<div class="discussion-info">
							<h4 class="nickname">宣州是爷</h4>
							<p>我在物质上的最高奢望就是，在一个和平的世界上，有一个健康的身体，过一种小康的日子。—— by 邓云华 ​​​​</p>
							<div class="left">2017-03-31</div>
						</div>
					</div>

					<div class="content-discussion clearfix">
						<div class="photo">
							<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
						</div>
						<div class="discussion-info">
							<h4 class="nickname">宣州是爷</h4>
							<p>我在物质上的最高奢望就是，在一个和平的世界上，有一个健康的身体，过一种小康的日子。—— by 邓云华 ​​​​</p>
							<div class="left">2017-03-31</div>
						</div>
					</div>

					<div class="alert alert-info">
						<a href="/" class="btn btn-info">登录以评论</a>
					</div>
				</div>
				<div class="content" id="abstract" style="display: none;padding: 10px;">
					{!! $info->abstract !!}
				</div>
			</div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>		
	</div>

	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?b819a6a70904703dd1926e26ba9554f0";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
	<script src="scripts/lib/jquery/jquery.min.js"></script>
	<script src="scripts/lib/vue/vue.min.js"></script>
	<!-- <script src="scripts/lib/bootstrap/bootstrap.min.js"></script> -->
	<script src="scripts/info.js"></script>
	<script src="scripts/ZeroClipboard.min.js"></script>
	<script type="text/javascript" src="/style/admin/lib/layer/2.4/layer.js"></script>
	<script type="text/javascript">
		function showContent(nav,obj)
		{
			$('#nav_abstract,#nav_comment').removeClass('active');
			$(nav).addClass('active');
			$('.content').hide();
			$(obj).show();
		}
		var client = new ZeroClipboard( document.getElementById("copy-button") );

		client.on( "ready", function( readyEvent ) {
			// alert( "ZeroClipboard SWF is ready!" );
			client.on( "aftercopy", function( event ) {
				// `this` === `client`
			    	// `event.target` === the element that was clicked
			    	//event.target.style.display = "none";
			    	//alert("Copied text to clipboard: " + event.data["text/plain"] );
			    	layer.msg('复制成功 ！',{icon:1,time:3000});
			  } );
		} );
	</script>
</body>
</html>



