<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<!-- <title> <?php echo e($info->brand); ?>-<?php echo e($info->country); ?>-<?php echo e($info->model); ?>-<?php echo e($info->version); ?>-<?php echo e($info->os); ?>-GSMGOOD</title> -->
	<title>
		<?php 
			$brand = explode('/',$info->brand);
			echo !empty($brand) ?  trim($brand [0]) : '';
		?>-<?php 
			$country = explode('/',$info->country);
			echo !empty($country [1]) ?  $country [1] : '';?>-<?php echo e($info->model); ?>-<?php echo e($info->version); ?>-<?php echo e($info->os); ?>-GSMGOOD</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link href="/scripts/lib/popover/jquery.webui-popover.min.css" rel="stylesheet">
	<link href="/style/css/info.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="<?php echo e(csrf_token()); ?>">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/load">GSMGOOD</a>
				</div>

				<div class="btnGroup">
					<?php if(empty(session('userInfo'))): ?>
						<a class="login-btn" href="/enter?type=login">登录</a>
						<a class="register-btn" href="/enter?type=register">注册</a>
					<?php else: ?>
						<a class="login-btn" href="/users"><?php echo e(session('userInfo.UserName')); ?></a>
						<a class="register-btn" href='/custome/logout'>退出</a>
					<?php endif; ?>
				</div>

				<div class="items">
					<ul>
						<li><a href="/load">首页</a></li>
						<!-- <li><a href="/">讨论区</a></li> -->
						<li><a href="/pay">充值</a></li>
						<li><a href="/feedback">意见反馈</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="box-container">
			<div class="account-info clearfix panel panel-default">
				<div class="layoutLeft well well-sm">
					<?php echo e($info->model); ?>

				</div>

				<div class="layoutRight">
					<h4 class="title">
						<?php $brand = explode('/',$info->brand);echo !empty($brand) ? trim($brand [0]) : '';?>/<?php $country = explode('/',$info->country);echo !empty($country [1]) ? $country [1] : '';?>/<?php echo e($info->model); ?>/<?php echo e($info->version); ?><em><?php echo e($info->os); ?></em>
					</h4>

					<div class="public">
						<span>上传者：<a href="/users">管理员</a></span>
						<span>点击量：<?php echo e($info->view_num); ?></span>
						<span>下载量：<?php echo e($info->download_num); ?></span>
					</div>

					<div class="info well well-sm clearfix">
						<div class="left"> 
							<ul>
								<li>品牌：<a href="/b?k=<?php echo e($info->brand); ?>"><?php $brand = explode('/',$info->brand);echo $brand [0];?></a></li>
								<li>区域/国家：<a href="/c?k=<?php echo e($info->country); ?>"><?php $country = explode('/',$info->country);echo $country [0];?></a></li>
								<li>型号：<a href="/d?k=<?php echo e($info->model); ?>"><?php echo e($info->model); ?></a></li>
								<li>版本号码：<a href="/e?k=<?php echo e($info->version); ?>"><?php echo e($info->version); ?></a></li> 
								<li>系统版本：<a href="/f?k=<?php echo e($info->os); ?>"><?php echo e($info->os); ?></a></li>
								<li>更新时间：<?php echo e(date('Y-m-d',strtotime($info->updated_at))); ?></li>
							</ul>
						</div>
						<div class="right">
							<div class="money"><em><?php echo e(number_format($info->price,2)); ?></em>金币</div>
							<div class="password alert alert-warning" id="copy-button" data-clipboard-text="<?php echo e($info->download_password); ?>" style="cursor: pointer;">密码: <?php echo e($info->download_password); ?> </div>
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
						<?php $__currentLoopData = $infoComment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="content-discussion clearfix">
							<div class="photo">
								<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
							</div>
							<div class="discussion-info">
								<h4 class="nickname"><?php echo e($val->user_name); ?></h4>
								<p><?php echo e($val->content); ?></p>
								<div class="left">
									<span><?php echo e($val->created_at); ?></span>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php if(empty(session('userInfo'))): ?>
							<div class="alert alert-info" style="margin-top: 25px;">
								<a href="/enter?type=login" class="btn login-btn btn-danger">登录以评论</a>
							</div>
						<?php else: ?>
							<div class="mesBoard">
								<div class="photo">
									<img src="http://bbs.romup.com/uc_server/avatar.php?uid=572434&size=thumbnail" alt="">
								</div>
								<form action="javascript:void(0)" id="info-comment">
									<div class="mes-content">
										<textarea class="form-control" id="message" placeholder="吐槽下吧呗，您的神回复将名留青史！" name="content"></textarea>
										<input type="hidden" name="info_id" value="<?php echo e($info->id); ?>">
									</div>

									<div class="message-submit">
										<button class="btn btn-info" type="submit">提交评论</button>
									</div>
								</form>
							</div>
						<?php endif; ?>
					</div>					
				</div>

				<div class="inner" v-show="(navShift == '2')">
					<div class="content">
						<?php echo $info->abstract; ?>

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



