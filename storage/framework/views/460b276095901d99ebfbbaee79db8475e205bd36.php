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
						<a href="/rom" class="btn btn-info"><i class="fa fa-add" ></i>上传ROM</a>

						<div class="item">
							<span data-type="1" @click="itemShiftEvent" <?php if(empty($_GET['status'])): ?> class="active" <?php endif; ?> onclick="window.location.href='/users'">全部<small>(<?php echo e($allcount); ?>)</small></span>
							<span data-type="1" @click="itemShiftEvent" <?php if(! empty($_GET['status']) && 2 == $_GET['status']): ?> class="active" <?php endif; ?> onclick="window.location.href='/users?status=2'">已发布<small>(<?php echo e($scount); ?>)</small></span>
							<span data-type="1" @click="itemShiftEvent" onclick="window.location.href='/users?status=1'" <?php if(! empty($_GET['status']) && 1 == $_GET['status']): ?> class="active" <?php endif; ?>>未审核<small>(<?php echo e($fcount); ?>)</small></span>
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
							<div class="row-11">操作</div>
						</div>

						<div class="list-item">
							<ul>
								<?php $__currentLoopData = $uinfoList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="row-01"><?php if($val->status == 1): ?> 审核中 <?php elseif(2 == $val->status): ?> 发布中 <?php else: ?> 审核不通过 <?php endif; ?></li>
								<li class="row-02"><?php echo e($val->brand); ?></li>
								<li class="row-03"><?php echo e($val->country); ?></li>
								<li class="row-04"><?php echo e($val->model); ?></li>
								<li class="row-05"><?php echo e($val->version); ?></li>
								<li class="row-06"><?php echo e($val->os); ?></li>
								<li class="row-07"><?php echo e($val->updated_at); ?></li>
								<li class="row-08"><?php echo e($val->type); ?></li>
								<li class="row-09"><?php echo e($val->price); ?></li>
								<li class="row-10"><?php echo e($val->download_num); ?></li>
								<?php if(2 == $val->status): ?>
									<li class="row-11"><a href="/a/<?php echo e($val->info_id); ?>" class="btn btn-info">下载</a></li>
								<?php else: ?> 
									<li class="row-11">-</li>
								<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
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
						<?php $__currentLoopData = $rechargeRecord; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="list-item">
							<ul>
								<li class="row-01">金币</li>
								<li class="row-02"><?php if($val->channel == 1): ?> 系统 <?php elseif($val->channel == 2): ?>支付宝 <?php else: ?> 登录 <?php endif; ?></li>
								<li class="row-03"><?php echo e($val->amount); ?></li>
								<li class="row-04"><?php if($val->status == 1): ?> finished <?php elseif($val->satus == 2): ?> fail <?php endif; ?></li>
								<li class="row-05"><?php echo e($val->created_at); ?> </li>
							</ul>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
							<?php $__currentLoopData = $buyRecord; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 	 	 	 	
							<ul>
								<li class="row-01">download</li>
								<li class="row-02">rom</li>
								<li class="row-03"><?php echo e($val->info_id); ?></li>
								<li class="row-04"><?php echo e($val->consume); ?></li>
								<li class="row-05">finished</li>
								<li class="row-06"><?php echo e($val->created_at); ?> </li>
							</ul>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="per-info panel panel-default panel">
				<div class="panel-body text-center">
					<div class="photo">
						<img src="<?php echo e(isset($userInfo->FaceIco) ? $userInfo->FaceIco : 'http://bbs.romup.com/uc_server/avatar.php?uid=11077&size=big'); ?>" alt="">
					</div>
					<div class="nickname"><?php echo e($userInfo->UserName); ?></div>

					<div class="info">
						<ul>
							<li>
								<span>登录名</span>
								<em><?php echo e($userInfo->UserName); ?></em>
							</li>
							<!-- <li>
								<span>电子邮箱</span>
								<em><a class="mainColor" <?php if($userInfo->UserEmail): ?> href="mailto:<?php echo e($userInfo->UserEmail); ?>" <?php else: ?> href="javascript:void(0)" <?php endif; ?>><?php echo e(isset($userInfo->UserEmail) ? $userInfo->UserEmail : '未设置'); ?></a></em>
							</li> -->
							 <li>
								<span>号码</span>
								<em><a class="mainColor" href="javascript:void(0)"><?php echo e($userInfo->Mobile); ?></a></em>
							</li>
							<li>
								<span>财富值</span>
								<em class="mainColor"><?php echo e(isset($userInfo->Balance) ? $userInfo->Balance : 0.00); ?></em>
							</li>
							<li>
								<span>注册时间</span>
								<em><?php echo e($userInfo->CreateTime); ?></em>
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



