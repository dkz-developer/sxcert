<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>GSMGOOD - 分享安卓最新鲜最好玩的资源</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="GSMGOOD - 分享安卓最新鲜最好玩的资源">
	<meta name="description" content="GSMGOOD - 分享安卓最新鲜最好玩的资源">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">
	
    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
	 <link rel="stylesheet" href="http://www.jq22.com/jquery/bootstrap-3.3.4.css">
    <link href="style/css/rom.css" rel="stylesheet">
</head>
<body>
	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/rom">GSMGOOD</a>
				</div>

				<div class="btnGroup">
					@if(empty(session('userInfo')))
						<a class="login-btn" href="/login">登录</a>
						<a class="register-btn" href="/register">注册</a>
					@else
						<a class="login-btn" href="/users">{{session('userInfo.UserName')}}</a>
						<a class="register-btn" href='/custome/logout'>退出</a>
					@endif
				</div>

				<div class="items">
					<ul>
						<li><a href="/rom">首页</a></li>
						<li><a href="/bbs">讨论区</a></li>
						<li><a href="/service">客服</a></li>
						<li><a href="/pay">充值</a></li>
						<li><a href="/feedback">意见反馈</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="panel panel-default panel-notice form">
						<div class="panel-heading">
							<div class="panel-title">
								<div class="breadcrumb">
									<ol>
										<li><a href="javascript:history.back()">返回</a></li>
										<li class="active">添加ROM</li>
									</ol>
								</div>
							</div>
						</div>

						<div class="panel-body">
							<form class="form-horizontal" role="form">
								<div class="form-group">
								  	<label for="brand" class="col-sm-2 control-label">品牌</label>
								  	<div class="col-sm-4">
								    	<select id="brand" class="selectpicker show-tick form-control" data-live-search="true">
									    	<option disabled selected style='display:none;'>选择一个品牌</option>  
									    	@foreach($brand as $val)
											<option value="{{$val->name}}">{{$val->name}}</option>
										@endforeach
								    	</select>
								  	</div>

								  	<label for="model" class="col-sm-2 control-label">机型</label>
								  	<div class="col-sm-4">
								    	<select id="model" class="selectpicker show-tick form-control" data-live-search="true">
									    	<option disabled selected style='display:none;'>选择一个机型</option> 
									    		@foreach ($model as $val)
											<option value="{{$val->name}}">{{$val->name}}</option>
											@endforeach
								    	</select>
								  	</div>
								</div>

								<div class="form-group">
								  	<label for="country" class="col-sm-2 control-label">国家</label>
								  	<div class="col-sm-4">
								    	<select id="country" class="selectpicker show-tick form-control" data-live-search="true">
									    	<option disabled selected style='display:none;'>选择一个国家</option>  
											@foreach ($country as $val)
											<option value="{{$val->name}}">{{$val->name}}</option>
											@endforeach
								    	</select>
								  	</div>

								  	<label for="os" class="col-sm-2 control-label">OS</label>
								  	<div class="col-sm-4">
								    	<select id="os" class="selectpicker show-tick form-control" data-live-search="true">
									    	<option disabled selected style='display:none;'>选择一个版本</option>  
											@foreach ($os as $val)
											<option value="{{$val->name}}">{{$val->name}}</option>
											@endforeach
								    	</select>
								  	</div>
								</div>

								<div class="form-group">
								  	<label for="type" class="col-sm-2 control-label">类型</label>
								  	<div class="col-sm-4">
								    	<select id="type" class="selectpicker show-tick form-control" data-live-search="true">
									    	<option disabled selected style='display:none;'>选择一个类型</option>  
											@foreach ($type as $val)
											<option value="{{$val->name}}">{{$val->name}}</option>
											@endforeach
								    	</select>
								  	</div>

								  	 <label for="qq" class="col-sm-2 control-label">单价(金币)</label>
						            <div class="col-sm-4">
						                <input type="text" class="form-control" id="price" value="" placeholder="请输入价格">
						            </div>
								</div>

								<div class="form-group">
						            <label for="qq" class="col-sm-2 control-label">版本</label>
						            <div class="col-sm-10">
						                <input type="text" class="form-control" id="version" value="" placeholder="请输入版本号">
						            </div>
						           
						        </div>

						        <div class="form-group">

						        	<label for="qq" class="col-sm-2 control-label">下载地址</label>
						            <div class="col-sm-10">
						                <input type="text" class="form-control" id="url" value="" placeholder="资源下载地址">
							        </div>
						        </div>

						        <div class="form-group">
						            <label for="qq" class="col-sm-2 control-label">备注</label>
						            <div class="col-sm-10">
						                <input type="text" class="form-control" id="note" value="" placeholder="下载密码/解压密码/注释框等">
						            </div>
						        </div>

								 <div class="form-group buttonRow">
						            <div class="col-sm-offset-2 col-sm-10">
						                <button type="button" id="submitBtn" class="btn btn-info btn-block"><i class="fa fa-pencil"></i> &nbsp;提交</button>
						            </div>
						        </div>
							</form>				
						</div>
					</div>				
				</div>

				<div class="col-sm-3">
					<div class="panel panel-default">
				        <div class="panel-heading">
				            <div class="panel-title">上传须知</div>
				        </div>
				        <div class="panel-body">
				            <p>您可以自由上传手上拥有的资源，并设定合适的价格。一旦审核通过并有会员购买下载，我们将给您的账户充值您设定价格的10%的金币。例如：您上传的ROM的价格为50金币。则，每次一旦有会员购买下载，我们都将给您的账户充值5个金币。</p>
				        </div>
				    </div>
				</div>
			</div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>
	</div>

	
	<script src="/scripts/lib/jquery/jquery.min.js"></script>
	<script src="/scripts/lib/bootstrap/bootstrap.min.js"></script>
	<script src="/scripts/lib/bootstrap/bootstrap-select.min.js"></script>
	<script src="/style/admin/lib/layer/2.4/layer.js"></script>
	<script src="/scripts/public/tools_admin.js"></script>
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/lib/is-js/is.min.js"></script>
	<script src="/scripts/rom.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	
</body>
</html>




