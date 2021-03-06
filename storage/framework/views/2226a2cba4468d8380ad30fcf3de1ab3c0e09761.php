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
    <link href="style/css/index.css" rel="stylesheet">
</head>
<body>

	<div id="app" data-value="<?php echo e(csrf_token()); ?>">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/load"><img src="images/logo_main3.png" alt=""></a>
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
						<?php if(empty(session('userInfo'))): ?>
							<li><a href="/enter?type=login">登录</a></li>
							<li><a href="/enter?type=register">注册</a></li>
						<?php else: ?>
							<li><a href="/users"><?php echo e(session('userInfo.UserName')); ?></a></li>
							<li><a href='/custome/logout'>退出</a></li>
						<?php endif; ?>
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
								<div class="photo"><img src="http://bos.nj.bpc.baidu.com/v1/developer/a3be4b6f-4795-4ae4-b97b-82eb68b34519.png" alt=""></div>
							</div>
						</li>
						<li class="height">
							<div class="font-content">
								<div class="photo"><img src="https://bos.nj.bpc.baidu.com/v1/developer/f8953830-0f8b-40e6-818a-09b830bf76f2.png" alt=""></div>
							</div>
						</li>
						<li class="height">
							<div class="font-content">
								<div class="photo"><img src="https://bos.nj.bpc.baidu.com/v1/developer/9cf08fab-2026-41c5-b9f4-e4d1c93075cc.png" alt=""></div>
							</div>
						</li>
					</ul>
				</div>	

				<div class="layout-right">
					<div class="tab clearfix">
						<div class="tab-list active"><span></span><a href="">最新主题</a></div>
						<div class="tab-list"><span></span><a href="">最新回复</a></div>
						<div class="tab-list"><span></span><a href="">热门帖子</a></div>
					</div>

					<div class="content">
						<div class="item">
							<ul>
								<li><span class="circle"></span><a href="">bae可以绑定自己的域名吗bae可以绑定自己的域名吗？和bch的区别在哪里呢？？和bch的区别在哪里呢？</a></li>
								<li><span class="circle"></span><a href="">bae可以绑定自己的域名吗？和bch的区别在哪里呢？</a></li>
								<li><span class="circle"></span><a href="">bae可以绑定自己的域名吗？和bch的区别在哪里呢？</a></li>
								<li><span class="circle"></span><a href="">bae可以绑定自己的域名吗？和bch的区别在哪里呢？</a></li>
								<li><span class="circle"></span><a href="">bae可以绑定自己的域名吗？和bch的区别在哪里呢？</a></li>
						</div>	
					</div>


				</div>
			</div>

			<div class="product clearfix">
				<h2>产品论坛</h2>
				<div class="content">
					<div class="product-list">
						<div class="first">
							<div class="title">云计算基础服务</div>
							<div class="pic">
								<img src="https://developer.baidu.com/resources/online/forum/bce/img/sky-ser.png">
							</div>
							<div class="discuss">
								<p>主题: <span>666</span></p>
								<p>帖子: <span>666</span></p>
							</div>
						</div>
					</div>

					<div class="product-list">
						<div class="first">
							<div class="title">云计算基础服务</div>
							<div class="pic">
								<img src="https://developer.baidu.com/resources/online/forum/bce/img/sky-ser.png">
							</div>
							<div class="discuss">
								<p>主题: <span>666</span></p>
								<p>帖子: <span>666</span></p>
							</div>
						</div>
					</div>

					<div class="product-list">
						<div class="first">
							<div class="title">云计算基础服务</div>
							<div class="pic">
								<img src="https://developer.baidu.com/resources/online/forum/bce/img/sky-ser.png">
							</div>
							<div class="discuss">
								<p>主题: <span>666</span></p>
								<p>帖子: <span>666</span></p>
							</div>
						</div>
					</div>

					<div class="product-list">
						<div class="first">
							<div class="title">云计算基础服务</div>
							<div class="pic">
								<img src="https://developer.baidu.com/resources/online/forum/bce/img/sky-ser.png">
							</div>
							<div class="discuss">
								<p>主题: <span>666</span></p>
								<p>帖子: <span>666</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="classify clearfix">
				<h2>分类板块</h2>
				<div class="content clearfix">
					<div class="classify-list">
						<div class="icon">
							<a href=""><img src="https://developer.baidu.com/resources/online/forum/bce/img/freshman-logo.png" alt=""></a>
						</div>
						<div class="info">
							<h4><a href="">新手专区</a></h4>
							<div class="introduction">
								<p>主题：1656666</p>
								<p>帖子：666</p>
								<p>版本：宣州是笨蛋</p>
							</div>	
						</div>
					</div>

					<div class="classify-list">
						<div class="icon">
							<a href=""><img src="https://developer.baidu.com/resources/online/forum/bce/img/record-service.png" alt=""></a>
						</div>
						<div class="info">
							<h4><a href="">备案服务</a></h4>
							<div class="introduction">
								<p>主题：1656666</p>
								<p>帖子：666</p>
								<p>版本：宣州是笨蛋</p>
							</div>						
						</div>
					</div>

					<div class="classify-list">
						<div class="icon">
							<a href=""><img src="https://developer.baidu.com/resources/online/forum/bce/img/buy-info.png" alt=""></a>
						</div>
						<div class="info">
							<h4><a href="">购买咨询</a></h4>
							<div class="introduction">
								<p>主题：1656666</p>
								<p>帖子：666</p>
								<p>版本：宣州是笨蛋</p>
							</div>
						</div>
					</div>

					<div class="classify-list">
						<div class="icon">
							<a href=""><img src="https://developer.baidu.com/resources/online/forum/bce/img/question.png" alt=""></a>
						</div>
						<div class="info">
							<h4><a href="">问题反馈</a></h4>
							<div class="introduction">
								<p>主题：1656666</p>
								<p>帖子：666</p>
								<p>版本：宣州是笨蛋</p>
							</div>	
						</div>
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
	<script src="scripts/lib/flickerplate.min.js"></script>
	<script src="scripts/public/tools.js"></script>
	<script src="scripts/public/topNav.js"></script>
	<script src="scripts/index.js"></script>
</body>
</html>



