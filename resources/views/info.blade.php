<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<!-- <title> {{$info->brand}}-{{$info->country}}-{{$info->model}}-{{$info->version}}-{{$info->os}}-GSMGOOD</title> -->
	<title>
		<?php 
			$brand = explode('/',$info->brand);
			echo !empty($brand) ?  trim($brand [0]) : '';
		?>-<?php 
			$country = explode('/',$info->country);
			echo !empty($country [1]) ?  $country [1] : '';?>-{{$info->model}}-{{$info->version}}-{{$info->os}}-GSMGOOD</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link href="/scripts/lib/popover/jquery.webui-popover.min.css" rel="stylesheet">
	<link href="/style/css/info.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/">GSMGOOD</a>
				</div>

				<div class="btnGroup">
					@if(empty(session('userInfo')))
						<a class="login-btn" href="/enter?type=login">登录</a>
						<a class="register-btn" href="/enter?type=register">注册</a>
					@else
						<a class="login-btn" href="/users?id={{session('userInfo.UserId')}}">{{session('userInfo.UserName')}}</a>
						<a class="register-btn" href='/custome/logout'>退出</a>
					@endif
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

		<div class="box-container">
			<div class="account-info clearfix panel panel-default">
				<div class="layoutLeft well well-sm">
					{{$info->model}}
				</div>

				<div class="layoutRight">
					<h4 class="title">
						<?php $brand = explode('/',$info->brand);echo !empty($brand) ? trim($brand [0]) : '';?>/<?php $country = explode('/',$info->country);echo !empty($country [1]) ? $country [1] : '';?>/{{$info->model}}/{{$info->version}}<em>{{$info->os}}</em>
					</h4>

					<div class="public">
						<span>上传者：<a href="/users">管理员</a></span>
						<span>点击量：{{$info->view_num}}</span>
						<span>下载量：{{$info->download_num}}</span>
					</div>

					<div class="info well well-sm clearfix">
						<div class="left"> 
							<ul>
								<li>品牌：<a href="/s?k=<?php $brand = explode('/',$info->brand);echo $brand[0];?>1"><?php $brand = explode('/',$info->brand);echo $brand [0];?></a></li>
								<li>区域/国家：<a href="/s?k=<?php $country = explode('/',$info->country);echo $country [0];?>2"><?php $country = explode('/',$info->country);echo $country [0];?></a></li>
								<li>型号：<a href="/s?k={{$info->model}}3">{{$info->model}}</a></li>
								<li>版本号码：<a href="/s?k={{$info->version}}4">{{$info->version}}</a></li> 
								<li>系统版本：<a href="/s?k={{$info->os}}5">{{$info->os}}</a></li>
								<li>更新时间：{{date('Y-m-d',strtotime($info->updated_at))}}</li>
							</ul>
						</div>
						<div class="right">
							<div class="money"><em>{{number_format($info->price,2)}}</em>金币</div>
							<div class="password alert alert-warning" id="copy-button" data-clipboard-text="{{$info->download_password}}" style="cursor: pointer;">密码: {{$info->download_password}} </div>
							<div class="loadBtn">
								<a class="btn btn-info" href="javascript:void(0);" @click="load">立即下载</a>
							</div>
						</div>
					</div>	
				</div>
			</div>

			<div class="main-info panel panel-default panel-notice">

				<div class="panel-heading panel-tabs">
					<ul class="nav nav-tabs">
					 	<li class="active" data-shift="1" @click="navShiftEvent"><a href="javascript:void(0);">评论</a></li>
						<li data-shift="2" @click="navShiftEvent"><a href="javascript:void(0);">介绍</a></li>
					</ul>
				</div>
				
				<div class="inner" v-show="(navShift == '1')">
					<div class="content">
						@foreach($infoComment as $val)
						<div class="content-discussion clearfix">
							<div class="photo">
								<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
							</div>
							<div class="discussion-info">
								<h4 class="nickname">{{$val->user_name}}</h4>
								<p>{{$val->content}}</p>
								<div class="left">
									<span>{{$val->created_at}}</span>
								</div>
							</div>
						</div>
						@endforeach
						@if(empty(session('userInfo')))
							<div class="alert alert-info" style="margin-top: 25px;">
								<a href="/enter?type=login" class="btn login-btn btn-danger">登录以评论</a>
							</div>
						@else
							<div class="mesBoard">
								<div class="photo">
									<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
								</div>
								<form action="javascript:void(0)" id="info-comment">
									<div class="mes-content">
										<textarea class="form-control" id="message" placeholder="吐槽下吧呗，您的神回复将名留青史！" name="content"></textarea>
										<input type="hidden" name="info_id" value="{{$info->id}}">
									</div>

									<div class="message-submit">
										<button class="btn btn-info" type="submit">提交评论</button>
									</div>
								</form>
							</div>
						@endif
					</div>					
				</div>

				<div class="inner" v-show="(navShift == '2')">
					<div class="content">
						{!! $info->abstract !!}
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
	<script src="/scripts/lib/popover/jquery.webui-popover.min.js"></script>
	<script src="/scripts/ZeroClipboard.min.js"></script>
	<script src="/style/admin/lib/layer/2.4/layer.js"></script>
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/info.js"></script>
</body>
</html>



