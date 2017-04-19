∂<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>  </title>

	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
     <link href="scripts/lib/kkpager/kkpager_blue.css" rel="stylesheet">
    <link href="style/css/search.css" rel="stylesheet">
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

				<div class="search">
					<input class="form-control" type="text" placeholder="输入机型或版本号(至少3个字符)" @keyup.enter="search">
					<button @click="search">搜一下</button>
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

		<div class="box-container" >
			<div class="main-content">
				<div class="listRec">
					<div class="header">
	                    <div class="row-02">品牌</div>
	                    <div class="row-03">区域 / 国家</div>
	                    <div class="row-04">型号</div>
	                    <div class="row-05">版本号</div>
	                    <div class="row-06">OS</div>
	                    <div class="row-07">资料类型</div>
	                    <div class="row-08">价格(金币)</div>
	                    <div class="row-09">更新日期</div>
	                    <div class="row-10">查看</div>
	                    <div class="row-11">下载</div>
	                    <div class="row-12">下载链接</div>
					</div>

					<div class="list-item" v-cloak v-for="(item,index) in list">
						@foreach($list as $val)
						<ul>
							<!-- <li class="row-01"><a :href="['/search?keyword='+item.tag ]">@{{item.tag}}</a></li> -->
							<li class="row-02"><a target="_blank" href="/s?i=1&k={{urlencode($val->brand)}}">{{$val->brand}}</a></li>
							<li class="row-03"><a target="_blank" href="/s?i=2&k={{urlencode($val->country)}}">{{$val->country}}</a></li>
							<li class="row-04"><a target="_blank" href="/s?i=3&k={{urlencode($val->model)}}">{{$val->model}}</a></li>
							<li class="row-05"><a target="_blank" href="/s?i=4&k={{urlencode($val->version)}}">{{$val->version}}</a></li>
							<li class="row-06"><a target="_blank" href="/s?i=5&k={{urlencode($val->os)}}">{{$val->os}}</a></li>
							<li class="row-07"><a target="_blank" href="/s?i=6&k={{urlencode($val->type)}}">{{$val->type}}</a></li>
							<li class="row-08">{{$val->price}}</li>
							<li class="row-09">{{$val->updated_at}}</li>
							<li class="row-10">{{$val->view_num}}</li>
							<li class="row-11">{{$val->download_num}}</li>
							<li class="row-12"><a target="_blank" href='/i/{{$val->id}}' class="btn btn-info">下载</a></li>
						</ul>
						@endforeach
						<!-- <ul>
							<li class="row-02"><a target="_blank" :href="['/search?keyword='+item.brand]">@{{item.brand}}</a></li>
							<li class="row-03"><a target="_blank" :href="['/search?keyword='+item.country | escape]">@{{item.country}}</a></li>
							<li class="row-04"><a target="_blank" :href="['/search?keyword='+item.model]">@{{item.model}}</a></li>
							<li class="row-05"><a target="_blank" :href="['/search?keyword='+item.version]">@{{item.version}}</a></li>
							<li class="row-06"><a target="_blank" :href="['/search?keyword='+item.os]">@{{item.os}}</a></li>
							<li class="row-07"><a target="_blank" :href="['/search?keyword='+item.type]">@{{item.type}}</a></li>
							<li class="row-08">@{{item.price}}</li>
							<li class="row-09">@{{item.updated_at}}</li>
							<li class="row-10">@{{item.view_num}}</li>
							<li class="row-11">@{{item.download_num}}</li>
							<li class="row-12"><a target="_blank" :href="['/info?keyword='+item.id]" class="btn btn-info">下载</a></li>
						</ul> -->
					</div>
					
				</div>
			</div>

		 	<div id="kkpager"></div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>		
	</div>
	
	<script src="scripts/lib/jquery/jquery.min.js"></script>
	<script src="scripts/lib/vue/vue.min.js"></script>
	<script src="scripts/public/tools.js"></script>
	<script src="scripts/lib/kkpager/kkpager.min.js"></script>
	<script src="scripts/public/tools.js"></script>
	<script src="scripts/public/topNav.js"></script>
	<!-- <script src="scripts/search.js"></script> -->
</body>
</html>



