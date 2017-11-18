<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>GSMGOOD - 分享安卓最新鲜最好玩的资源</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="{{$keyword->content}}">
	<meta name="description" content="{{$search->content}}">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="style/css/pay.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/bbs"><img src="images/logo_main3.png" alt=""></a>
				</div>
				<div class="search">
					<form action="/forum/topic/" id="search">
						<input type="text" placeholder="请输入..." name="keyword">	
						<span class="fa fa-search"></span>
					</form>
				</div>
				<div class="items clearfix">
					<ul>
						<li><a href="/bbs">首页</a></li>
						<li><a href="/rom">下载站</a></li>
						<li><a href="/pay">充值</a></li>
						<li><a href="/fuwu">服务</a></li>
						<li><a href="/service">客服</a></li>
						@if(empty(session('userInfo')))
							<li><a href="/login">登录</a></li>
							<li><a href="/register">注册</a></li>
						@else
							<li><a href="/users">{{session('userInfo.UserName')}}</a></li>
							<li><a href='/custome/logout'>退出</a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="main">
				<div class="main-title">支付宝(alipay)</div>
				<div class="main-content">
					<form action="javascript:void(0)" data-act="pay" method="get" id="pays">
						<div class="input-prepend">
							<input class="restyle" id="pay" placeholder="请输入充值金额，最低1元" type="number" id="mobile" v-on:blur="verification" data-error="充值金额不能为空" name="amount">
							<i class="fa fa-rmb"></i>
						</div>

						<div class="alert alert-info">
							支付宝充值：1元=10个金币
						</div>	

						<div class="submitBtn">
							<button type="submit" class="btn btn-info" @click="submit">立即充值</button>
						</div>
					</form>
				</div>
			</div>

			<div class="main" style="display: block;">
				<div class="main-title">贝宝(PayPal)</div>
				<div class="main-content">
					<!-- <form style="width: 100%;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_xclick">
						<input type="hidden" name="business" value="shuua520@gmail.com">
						<input type="hidden" name="lc" value="US">
						<input type="hidden" name="button_subtype" value="services">
						<input type="hidden" name="no_note" value="0">
						<input type="hidden" name="currency_code" value="USD">
						<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
						<table style="width: 100%;" >
						<tr><td style="padding-bottom: 14px; font-size: 16px; color: #666;"><input type="hidden" name="on0" value="Please select items">Please select items</td></tr><tr><td><select name="os0">
							<option value="Credit 500=">Credit 500= $10.00 USD</option>
							<option value="Credit 1000=">Credit 1000= $20.00 USD</option>
							<option value="Year VIP member=">Year VIP member= $250.00 USD</option>
						</select> </td></tr>
						</table>
						<input type="hidden" name="currency_code" value="USD">
						<input type="hidden" name="option_select0" value="Credit 500=">
						<input type="hidden" name="option_amount0" value="10.00">
						<input type="hidden" name="option_select1" value="Credit 1000=">
						<input type="hidden" name="option_amount1" value="20.00">
						<input type="hidden" name="option_select2" value="Year VIP member=">
						<input type="hidden" name="option_amount2" value="250.00">
						<input type="hidden" name="option_index" value="0">
						<input style="margin: 16px 0;" type="image" src="https://www.paypalobjects.com/zh_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal——最安全便捷的在线支付方式！">
						<img alt="" border="0" src="https://www.paypalobjects.com/zh_XC/i/scr/pixel.gif" width="1" height="1">
					</form> -->


					<form style="width: 100%;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="X8WXWBL8L2C34">
						<table  style="width: 100%;" >
						<tr><td style="padding-bottom: 14px; font-size: 16px; color: #666;"><input type="hidden" name="on0" value="Please select items">Please select items</td></tr><tr><td><select name="os0">
							<option value="Credit 500="> $ 15.00 USD</option>
							<option value="Credit 1000=">Credit 1000= $ 20.00 USD</option>
							<option value="Year VIP member=">Year VIP member= $ 300.00 USD</option>
						</select> </td></tr>
						</table>
						<input type="hidden" name="currency_code" value="USD">
						<img src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" style="margin: 10px 0;">
						<!-- <input style="margin: 16px 0;" type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0"  alt="PayPal - The safer, easier way to pay online!"> -->
						<img alt="" border="0" src="https://www.paypalobjects.com/zh_XC/i/scr/pixel.gif" width="1" height="1">
					</form>

				</div>
					
			</div>
				
		</div>

		<div class="footer">
			<p>Copyright © 2017 - <a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank">粤ICP备17024526号-1</a></p>
		</div>		
	</div>
	
	<script src="/scripts/lib/jquery/jquery.min.js"></script>
	<script src="/scripts/lib/vue/vue.min.js"></script>
	<script src="/style/admin/lib/layer/2.4/layer.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#pays').submit(function (){
				var amount = parseInt($('#pay').val());
				if(amount < 1)
					return false;
				var data  = $(this).serialize();
				$.get('/alpay',data,function(data){
					if(data.url)
						window.location.href=data.url;
					else 
						layer.msg(data.msg,{icon:2,time:2000});
				});
			})

			$("select[name=os0]").change(function() {
				if($(this).val() == "Credit 500=") {
					var new_open = window.open('_blank');
					new_open.location='http://www.paypal.me/gsmgood/15';
				}else if($(this).val() == "Credit 1000=") {
					var new_open = window.open('_blank');
					new_open.location='http://www.paypal.me/gsmgood/15';
				}else if($(this).val() == "Year VIP member=") {
					var new_open = window.open('_blank');
					new_open.location='http://www.paypal.me/gsmgood/300';
				}
			})
			return false;
		});
	</script>
</body>
</html>
