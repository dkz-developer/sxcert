a<!DOCTYPE html>
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
    <link href="style/css/load.css" rel="stylesheet">
</head>
<body>
	<nav class="clearfix">
		<div class="inner">
			<div class="logo">
				<a href="/">LOGO暂定</a>
			</div>

			<div class="btnGroup">
				<a class="login-btn" href="/login">登录</a>
				<a class="register-btn" href="/register">注册</a>
			</div>

			<div class="items">
				<ul>
					<li><a class="active" href="/load">首页</a></li>
					<li><a href="">讨论区</a></li>
					<li><a href="">充值</a></li>
				</ul>
			</div>

		</div>
	</nav>

	<div class="box-container" id="app" data-value="{{ csrf_token() }}">
	
		<div class="logo">
			<a href="/load"><img src="images/logo.png" alt=""></a>
		</div>

		<div class="search">
			<input class="form-control" type="text" placeholder="输入机型或版本号(至少3个字符)">
			<button @click="search">JUST搜搜</button>
		</div>

		<div class="main-content">
			
			<div class="hotRec">
				<h3 class="title">热门推荐</h3>
				<div class="header">
					<div class="row-01">标签</div>
                    <div class="row-02">品牌</div>
                    <div class="row-03">区域 / 国家</div>
                    <div class="row-04">型号</div>
                    <div class="row-05">版本号</div>
                    <div class="row-06">Android OS</div>
                    <div class="row-07">资料类型</div>
                    <div class="row-08">价格(金币)</div>
                    <div class="row-09">更新日期</div>
                    <div class="row-10">查看</div>
                    <div class="row-11">下载</div>
                    <div class="row-12">下载链接</div>
				</div>

	
				<div class="list-item" v-cloak v-for="(item,index) in list">
					<ul>
						<li class="row-01"><a :href="['/load_search?keyword='+item.tag]">@{{item.tag}}</a></li>
						<li class="row-02"><a :href="['/load_search?keyword='+item.brand]">@{{item.brand}}</a></li>
						<li class="row-03"><a :href="['/load_search?keyword='+item.country]">@{{item.country}}/ALL</a></li>
						<li class="row-04"><a :href="['/load_search?keyword='+item.model]">@{{item.model}}</a></li>
						<li class="row-05"><a :href="['/load_search?keyword='+item.version]">@{{item.version}}</a></li>
						<li class="row-06"><a :href="['/load_search?keyword='+item.os]">@{{item.os}}</a></li>
						<li class="row-07"><a :href="['/load_search?keyword='+item.type]">@{{item.type}}</a></li>
						<li class="row-08">@{{item.price}}</li>
						<li class="row-09">@{{item.updated_at}}</li>
						<li class="row-10">@{{item.view_num}}</li>
						<li class="row-11">@{{item.download_num}}</li>
						<li class="row-12"><a :href="['/load_info?keyword='+item.id]" class="btn btn-info">下载</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="footer">
		<p>粤ICP备17024526号-1</p>
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
	<script src="scripts/load.js"></script>
</body>
</html>



