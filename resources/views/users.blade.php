a<!DOCTYPE html>
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
    <link href="style/css/users.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/rom">GSMGOOD</a>
				</div>

				<div class="btnGroup">
					@if(empty(session('userInfo')))
						<a class="login-btn" href="/login">登录</a>
						<a class="register-btn" href="/register">注册</a>
					@else
						<a class="login-btn" href="/users">{{session('userInfo.UserName')}}</a>
						<a class="register-btn" href='/custome/logout'>退出</a>
					@endif
				</div>

				<div class="items">
					<ul>
						<li><a href="/rom">首页</a></li>
						<!-- <li><a href="/">讨论区</a></li> -->
						<li><a href="/pay">充值</a></li>
						<li><a href="/feedback">意见反馈</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="box-container clearfix">
			<div class="main-content panel panel-default panel-notice">
				<div class="panel-heading panel-tabs">
					<ul class="nav nav-tabs">
					 	<li class="active" data-shift="1" @click="navShiftEvent"><a href="javascript:void(0);">我的ROM</a></li>
						<li data-shift="2" @click="navShiftEvent"><a href="javascript:void(0);">充值记录</a></li>
						<li data-shift="3" @click="navShiftEvent"><a href="javascript:void(0);">消费记录</a></li>
					</ul>
				</div>

				<div class="content" v-cloak v-if="(navShift == '1')">
					<div class="title">
						<a href="/firmware" class="btn btn-info"><i class="fa fa-add" ></i>上传ROM</a>

						<div class="item">
							<span data-type="1" @click="itemShiftEvent" @if(empty($_GET['status'])) class="active" @endif onclick="window.location.href='/users'">全部<small>({{$allcount}})</small></span>
							<span data-type="1" @click="itemShiftEvent" @if(! empty($_GET['status']) && 2 == $_GET['status']) class="active" @endif onclick="window.location.href='/users?status=2'">已发布<small>({{$scount}})</small></span>
							<span data-type="1" @click="itemShiftEvent" onclick="window.location.href='/users?status=1'" @if(! empty($_GET['status']) && 1 == $_GET['status']) class="active" @endif>未审核<small>({{$fcount}})</small></span>
						</div>
					</div>
					<div class="inner inner-nav1">
						<div class="header">
							<div class="row-01">状态</div>
							<div class="row-02">品牌</div>
							<div class="row-03">国家</div>
							<div class="row-04">型号</div>
							<div class="row-05">版本</div>
							<div class="row-06">OS</div>
							<div class="row-07">更新日期</div>
							<div class="row-08">类型</div>
							<div class="row-09">价格</div>
							<div class="row-10">下载量</div>
						</div>

						@foreach($uinfoList as $val)
						<div class="list-item">
							<ul>
								<li class="row-01">@if($val->status == 1) 审核中 @elseif(2 == $val->status) 发布中 @else 审核不通过 @endif</li>
								<li class="row-02">{{$val->brand}}</li>
								<li class="row-03">{{$val->country}}</li>
								<li class="row-04">{{$val->model}}</li>
								<li class="row-05">{{$val->version}}</li>
								<li class="row-06">{{$val->os}}</li>
								<li class="row-07">{{date('Y-m-d',strtotime($val->created_at))}}</li>
								<li class="row-08">{{$val->type}}</li>
								<li class="row-09">{{$val->price}}</li>
								<li class="row-10">{{$val->download_num}}</li>
							</ul>
						</div>
						@endforeach
						<div style="text-align: center;overflow: hidden;">
							{{$uinfoList->links()}}
						</div>
					</div>
				</div>

				<div class="content" v-cloak v-if="(navShift == '2')">
					<div class="title">
						<div class="item">
							<!-- <span data-type="1" class="active" @click="itemShiftEvent">全部<small>(13947)</small></span>
							<span data-type="1" @click="itemShiftEvent">新充值<small>(13947)</small></span>
							<span data-type="1" @click="itemShiftEvent">充值中<small>(13947)</small></span>
							<span data-type="1" @click="itemShiftEvent">充值完毕<small>(13947)</small></span> -->
						</div>
					</div>
					<div class="inner inner-nav2"> 	 	 	 	
						<div class="header">
							<div class="row-01">主题</div>
							<div class="row-02">渠道</div>
							<div class="row-03">金额</div>
							<div class="row-04">状态</div>
							<div class="row-05">日期</div>
						</div>
						@foreach($rechargeRecord as $val)
						<div class="list-item">
							<ul>
								<li class="row-01">金币</li>
								<li class="row-02">@if($val->channel == 1) 系统 @elseif($val->channel == 2)支付宝 @else 登录 @endif</li>
								<li class="row-03">{{$val->amount}}</li>
								<li class="row-04">@if($val->status == 1) finished @elseif($val->satus == 2) fail @endif</li>
								<li class="row-05">{{date('Y-m-d',strtotime($val->created_at))}} </li>
							</ul>
						</div>
						@endforeach
						<div style="text-align: center;overflow: hidden;">
							{{$rechargeRecord->links()}}
						</div>
					</div>
				</div>

				<div class="content" v-cloak v-if="(navShift == '3')"> 
					<div class="title">
						<div class="item">
							<!-- <span data-type="1" class="active" @click="itemShiftEvent">全部<small>(13947)</small></span>
							<span data-type="1" @click="itemShiftEvent">交易完毕<small>(13947)</small></span>
							<span data-type="1" @click="itemShiftEvent">未发货<small>(13947)</small></span>
							<span data-type="1" @click="itemShiftEvent">退款<small>(13947)</small></span> -->
						</div>
					</div>
					<div class="inner inner-nav3"> 	 	 	 	 
						<div class="header">  	 	 	 	 	
							<div class="row-01">方式</div>
							<div class="row-02">商品类型</div>
							<div class="row-03">商品</div>
							<div class="row-04">消费</div>
							<div class="row-05">状态</div>
							<div class="row-06">日期</div>
						</div>

						<div class="list-item">  	
							@foreach($buyRecord as $val) 	 	 	 	
							<ul>
								<li class="row-01">download</li>
								<li class="row-02">rom</li>
								<li class="row-03">{{$val->info_id}}</li>
								<li class="row-04">{{$val->consume}}</li>
								<li class="row-05">finished</li>
								<li class="row-06">{{date('Y-m-d',strtotime($val->created_at))}} </li>
							</ul>
							@endforeach
						</div>
						<div style="text-align: center;overflow: hidden;">
							{{$buyRecord->links()}}
						</div>
					</div>
				</div>
			</div>

			<div class="per-info panel panel-default panel">
				<div class="panel-body text-center">
					<div class="photo">
						<img src="{{$userInfo->FaceIco or 'http://bbs.romup.com/uc_server/avatar.php?uid=11077&size=big'}}" alt="">
					</div>
					<div class="nickname">{{$userInfo->UserName}}</div>

					<div class="info">
						<ul>
							<li>
								<span>登录名</span>
								<em>{{$userInfo->UserName}}</em>
							</li>
							<!-- <li>
								<span>电子邮箱</span>
								<em><a class="mainColor" @if($userInfo->UserEmail) href="mailto:{{$userInfo->UserEmail}}" @else href="javascript:void(0)" @endif>{{$userInfo->UserEmail or '未设置'}}</a></em>
							</li> -->
							 <li>
								<span>号码</span>
								<em><a class="mainColor" href="javascript:void(0)">{{$userInfo->Mobile}}</a></em>
							</li>
							<li>
								<span>财富值</span>
								<em class="mainColor">{{$userInfo->Balance or 0.00}}</em>
							</li>
							<li>
								<span>注册时间</span>
								<em>{{$userInfo->CreateTime}}</em>
							</li>
							<li>
								<button class="btn btn-danger btn-block" onclick="window.location.href='/pay'">立即充值</button>
								<!-- <button class="btn btn-primary" onclick="window.location.href='/personInfo'">修改资料</button> -->
							</li>
						</ul>
					</div>

				</div>

			</div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>		
	</div>

	<script src="scripts/lib/jquery/jquery.min.js"></script>
	<script src="scripts/lib/vue/vue.min.js"></script>
	<script src="scripts/public/tools.js"></script>
	<script src="scripts/public/topNav.js"></script>
	<script src="scripts/users.js"></script>
</body>
</html>



