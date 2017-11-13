<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>GSMGOOD - 分享安卓最新鲜最好玩的资源</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">
    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//at.alicdn.com/t/font_468868_saiayzgnsj4te29.css" rel="stylesheet">
    <link rel="stylesheet" href="/scripts/lib/layui/css/layui.css">
    <link href="/style/css/serve.css" rel="stylesheet">
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
						<li><a href="/service">客服</a></li>
						@if(empty(session('userInfo')))
							<li><a href="/login">登录</a></li>
							<li><a href="/register">注册</a></li>
						@else
							<li><a href="/users?id={{session('userInfo.UserId')}}">{{session('userInfo.UserName')}}</a></li>
							<li><a href='/custome/logout'>退出</a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="inner">
				<table class="layui-table">
                    <thead>
                      <tr>   
                        <th>服务项目</th>
                        <th>类型</th>
                        <th>所需时间</th>
                        <th>价格</th>
                      </tr> 
                    </thead>
                    <tbody>
                    @foreach($list as $val)
                      <tr>
                        <td><a href="/fuwu/{{$val->id}}" target="_blank">{{$val->title}} </a></td>
                        <td><!-- <i class="iconfont icon-gold"></i> -->{{$val->type}}</td>
                        <td>{{$val->need_date}}</td>
                        <td>{{$val->price}}</td>
                      </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="float:right">{{ $list->links() }}</div>
			</div>
			
		</div>

		<div class="footer">
			<p>Copyright © 2017 - <a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank">粤ICP备17024526号-1</a></p>
		</div>		
	</div>
	<script src="/scripts/lib/jquery/jquery.min.js"></script>
	<script src="/scripts/lib/vue/vue.min.js"></script>
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	<script src="/scripts/service.js"></script>
    <script src="/scripts/lib/layui/layui.js"></script>

</body>
</html>
