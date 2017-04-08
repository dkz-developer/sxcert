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
    <link href="style/css/users.css" rel="stylesheet">
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

		<div class="box-container clearfix" id="app" data-value="{{ csrf_token() }}">
			<div class="main-content panel panel-default panel-notice">
				<div class="panel-heading panel-tabs">
					<ul class="nav nav-tabs">
					 	<li class="active"><a href="javascript:void(0);">我的ROM</a></li>
						<li><a href="javascript:void(0);">充值记录</a></li>
						<li><a href="javascript:void(0);">消费记录</a></li>
					</ul>
				</div>

				<div class="content">
					<div class="title">
						<button class="btn btn-info"><i class="fa fa-add"></i>上传ROM</button>
						<div class="item">
							<span class="active">全部<small>(13947)</small></span>
							<span>已发布<small>(13947)</small></span>
							<span>未审核<small>(13947)</small></span>
						</div>
					</div>
					<div class="inner">
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
							<div class="row-11">操作</div>
						</div>

						<div class="list-item">
							<ul>
								<li class="row-01">已发布</li>
								<li class="row-02">三星</li>
								<li class="row-03">中国</li>
								<li class="row-04">SM-G935A </li>
								<li class="row-05">G935AUCS4BQC2</li>
								<li class="row-06">7.0</li>
								<li class="row-07">2017-04-03</li>
								<li class="row-08">全资料[五件套]</li>
								<li class="row-09">150.0</li>
								<li class="row-10">6666</li>
								<li class="row-11"><a :href="['/info?keyword='+item.id]" class="btn btn-info">下载</a></li>
							</ul>
						</div>

						<div class="list-item">
							<ul>
								<li class="row-01">已发布</li>
								<li class="row-02">三星</li>
								<li class="row-03">中国</li>
								<li class="row-04">SM-G935A </li>
								<li class="row-05">G935AUCS4BQC2</li>
								<li class="row-06">7.0</li>
								<li class="row-07">2017-04-03</li>
								<li class="row-08">全资料[五件套]</li>
								<li class="row-09">150.0</li>
								<li class="row-10">6666</li>
								<li class="row-11"><a :href="['/info?keyword='+item.id]" class="btn btn-info">下载</a></li>
							</ul>
						</div>

						<div class="list-item">
							<ul>
								<li class="row-01">已发布</li>
								<li class="row-02">三星</li>
								<li class="row-03">中国</li>
								<li class="row-04">SM-G935A </li>
								<li class="row-05">G935AUCS4BQC2</li>
								<li class="row-06">7.0</li>
								<li class="row-07">2017-04-03</li>
								<li class="row-08">全资料[五件套]</li>
								<li class="row-09">150.0</li>
								<li class="row-10">6666</li>
								<li class="row-11"><a :href="['/info?keyword='+item.id]" class="btn btn-info">下载</a></li>
							</ul>
						</div>

						<div class="list-item">
							<ul>
								<li class="row-01">已发布</li>
								<li class="row-02">三星</li>
								<li class="row-03">中国</li>
								<li class="row-04">SM-G935A </li>
								<li class="row-05">G935AUCS4BQC2</li>
								<li class="row-06">7.0</li>
								<li class="row-07">2017-04-03</li>
								<li class="row-08">全资料[五件套]</li>
								<li class="row-09">150.0</li>
								<li class="row-10">6666</li>
								<li class="row-11"><a :href="['/info?keyword='+item.id]" class="btn btn-info">下载</a></li>
							</ul>
						</div>

						<div class="list-item">
							<ul>
								<li class="row-01">已发布</li>
								<li class="row-02">三星</li>
								<li class="row-03">中国</li>
								<li class="row-04">SM-G935A </li>
								<li class="row-05">G935AUCS4BQC2</li>
								<li class="row-06">7.0</li>
								<li class="row-07">2017-04-03</li>
								<li class="row-08">全资料[五件套]</li>
								<li class="row-09">150.0</li>
								<li class="row-10">6666</li>
								<li class="row-11"><a :href="['/info?keyword='+item.id]" class="btn btn-info">下载</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="per-info panel panel-default panel">
				<div class="panel-body text-center">
					<div class="photo">
						<img src="http://bbs.romup.com/uc_server/avatar.php?uid=11077&size=big" alt="">
					</div>
					<div class="nickname">张三丰</div>

					<div class="info">
						<ul>
							<li>
								<span>登录名</span>
								<em>张三丰</em>
							</li>
							<li>
								<span>电子邮箱</span>
								<em><a class="mainColor" href="mailto:lqhorochi@163.com">lqhorochi@163.com</a></em>
							</li>
							<li>
								<span>财富值</span>
								<em class="mainColor">323741.0</em>
							</li>
							<li>
								<span>注册时间</span>
								<em>2014-04-11 20:37:14</em>
							</li>
							<li>
								<button class="btn btn-danger">立即充值</button>
								<button class="btn btn-primary">修改资料</button>
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
	<script src="scripts/users.js"></script>
</body>
</html>


