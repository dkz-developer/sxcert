<!DOCTYPE html>
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
    <link href="style/css/service.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/"><img src="images/logo_main3.png" alt=""></a>
				</div>
				<div class="search">
					<input type="text" placeholder="请输入...">	
					<span class="fa fa-search"></span>
				</div>
				<div class="items clearfix">
					<ul>
						<li><a href="/load">下载站</a></li>
						<li><a href="/pay">充值</a></li>
						<li><a href="/service">客服</a></li>
						<li><a href="/enter?type=login">登录</a></li>
						<li><a href="/enter?type=register">注册</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			
			<div class="help">
				<h3 class="title"><a href="/">返回论坛主页面</a></h3>
				<p>刷机客服工作时间段： 9：00 -- 22：00</p>
				<div class="seperate"></div>
				<div class="services">
					<ul>
						<li>客服一：503616985 <a href=""><img src="images/qq.png" alt="">k</a> 处理范围：三星刷机</li>
						<li>客服一：503616985 <img src="" alt=""> 处理范围：三星刷机</li>
						<li>客服一：503616985 <img src="" alt=""> 处理范围：三星刷机</li>
						<li>客服一：503616985 <img src="" alt=""> 处理范围：三星刷机</li>
						<li>客服一：503616985 <img src="" alt=""> 处理范围：三星刷机</li>
					</ul>
				</div>
			</div>
				
			<div class="contact">
				
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
	<script src="scripts/public/tools.js"></script>
	<script src="scripts/service.js"></script>

</body>
</html>
