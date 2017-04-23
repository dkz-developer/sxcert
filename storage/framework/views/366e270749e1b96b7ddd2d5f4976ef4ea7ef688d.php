﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link href="/style/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/style/admin/static/h-ui/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/style/admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/style/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<title>后台登录 - H-ui.admin.page v3.0</title>
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
	<div id="loginform" class="loginBox">
		<form class="form form-horizontal" action="javascript:void(0)" method="post" id="loginForm">
			<div class="row cl">
				<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
				<div class="formControls col-xs-8">
					<input id="" name="userName" type="text" placeholder="用户名" class="input-text size-L" value="<?php echo e(old('userName')); ?>">
				</div>
			</div>
			<?php echo e(csrf_field()); ?>

			<div class="row cl">
				<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
				<div class="formControls col-xs-8">
					<input id="" name="password" value="<?php echo e(old('password')); ?>" type="password" placeholder="密码" class="input-text size-L">
				</div>
			</div>
			<div class="row cl">
				<div class="formControls col-xs-8 col-xs-offset-3">
					<input class="input-text size-L" type="text" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;" name="captcha">
					<img src="<?php echo e(URL('admin/kit/captcha/1')); ?>" id="verifyCode" onclick="re_captcha()" style="cursor: pointer;">
					<a id="kanbuq" href="javascript:re_captcha();">看不清，换一张</a>
				</div>
			</div>
			<div class="row cl">
				<div class="formControls col-xs-8 col-xs-offset-3">
					<label for="online" id="errorInfo" style="color:red;"></label>
				</div>
			</div>
			<div class="row cl">
				<div class="formControls col-xs-8 col-xs-offset-3">
					<input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
					<input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="footer">Copyright 你的公司名称 by H-ui.admin.page.v3.0</div>

<script type="text/javascript" src="/style/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/style/admin/static/h-ui/js/H-ui.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
	var hm = document.createElement("script");
	hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
	var s = document.getElementsByTagName("script")[0]; 
	s.parentNode.insertBefore(hm, s);
})();

function re_captcha() {
    	o_o = "<?php echo e(URL('admin/kit/captcha')); ?>";
    	o_o = o_o + "/" + Math.random();
    	document.getElementById('verifyCode').src = o_o;
}

$('#loginForm').submit(function(){
	var param = $(this).serialize();
	$.ajaxSetup(
		{
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:"/admin/loginHandle",
			data:param,
			dataType:'json',
			type:'post',
			success:function(result) {
				if(result.code != 'S') {
					re_captcha();
					$('#errorInfo').text(result.msg);
				}else {
					window.location.href = result.url;
				}
			}
		}
	);
	$.ajax();
	return false;
})
	

		
	

</script>
</body>
</html>