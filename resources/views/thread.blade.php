<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
	<meta charset="utf-8">
	<title>{{$list->title}} - GSMGOOD - 分享安卓最新鲜最好玩的资源</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1" />
	<meta name="viewport" contant="width=device-width, initial-scale=1">
	<meta name="keywords" content="{{$keyword->content}}">
	<meta name="description" content="{{$search->content}}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="/images/favicon.ico" rel="icon" type="image/icon">

    <link href="//cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/style/css/thread.css" rel="stylesheet">
</head>
<body>

	<div id="app" data-value="{{ csrf_token() }}">
		<nav class="clearfix">
			<div class="inner">
				<div class="logo">
					<a href="/rom"><img src="/images/logo_main3.png" alt=""></a>
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
							<li><a href="/users">{{session('userInfo.UserName')}}</a></li>
							<li><a href='/custome/logout'>退出</a></li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="breadcrumbs">
			 	<a href="/bbs">论坛首页</a>
				<i class="fa fa-angle-right"></i>
				<a href="/forum/topic/{{$themeInfo->id}}">{{$themeInfo->theme_name}}</a>
			</div>

			<div class="inner">

				<div class="reply-list">
					@if(!empty($list))
					<div class="reply-list-item">
						<div class="layout-left">
							<div class="username">{{$list->user_name}}</div>
							<div class="info">
								<div class="marker">楼主</div>
								<div class="photo">
									<img src="https://developer.baidu.com/resources/online/forum/img/photo.png" >
								</div>

								<div class="info-nums">
									<div class="item">
										<span class="data">{{$list->article_num}}</span>
										<span class="type">主题数</span>
									</div>

									<div class="item">
										<span class="data">{{$list->reply_num}}</span>
										<span class="type">回复数</span>
									</div>
								</div>

							</div>
						</div>
						<div class="layout-right">
							
							<div class="header">
								<span class="floor">楼主</span>
								<span class="time">发表于 {{date('Y.m.d H:i:s',strtotime($list->created_at))}}</span>
								<span class="prev">{{$list->view_num}} 浏览</span>
								<span class="replys">4 回复</span>
								<span class="goods"><small id="goods{{$list->id}}" style="font-size: 12px;">{{$list->like_num}}</small> 赞</span>
							</div>

							<div class="content">
								<h3 style="font-size: 24px;font-weight: 400;line-height: 30px;margin: 10px 0 15px;text-align: center;">{{$list->title}}</h3>
								@if(0 == $list->money)
									{!!$list->content!!}
								@else
									<div style="border:1px dashed #999;height: 60px;border-radius: 3px;text-align: center;line-height: 60px;background-color: #FFFFCC;color: #999">
										帖子内容售价{{intval($list->money)}}金币 <a href="">点我购买查看 </a>
									</div>
								@endif
							</div>

							<div class="bottom">
							@if(!empty(session('userInfo')) && 0 == $list->count)
								<a href="javascript:void(0)" class="goods" article_id="{{$list->id}}" ><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 点赞</a>
								<small style="color: #d6d6d6;margin: 0 10px;color: #999">|</small> 
							@endif
								<a href="javascript:void(0);" class="scroll"><i class="fa fa-comment-o"></i> 回复</a>
							</div>

						</div>
					</div>
					@endif
					@foreach($replylist as $key=>$val)
					<div class="reply-list-item" <?php if(isset($_GET ['replyId']) && $_GET ['replyId'] == $val->id) echo "id='lastReply'"?>>
						<div class="layout-left">
							<div class="username">{{$val->user_name}}</div>
							<div class="info">
								<div class="marker"><?php $page = isset($_GET ['page'])  ? $_GET ['page'] : 1;echo ($page-1) *5 + $key + 2;?>楼</div>
								<div class="photo">
									<img src="https://developer.baidu.com/resources/online/forum/img/photo.png" >
								</div>

								<div class="info-nums">
									<div class="item">
										<span class="data">{{$val->article_num}}</span>
										<span class="type">主题数</span>
									</div>

									<div class="item">
										<span class="data">{{$val->reply_num}}</span>
										<span class="type">回复数</span>
									</div>
								</div>

							</div>
						</div>
						<div class="layout-right">
							
							<div class="header">
								<span class="floor"><?php $page = isset($_GET ['page']) ? $_GET ['page'] : 1;echo ($page-1) *5 + $key + 2;?>楼</span>
								<span class="time">发表于 {{date('Y.m.d H:i:s',strtotime($val->created_at))}}</span>
								<!-- <span class="prev">1556 浏览</span>
								<span class="replys">4 回复</span> -->
								<span class="goods"><small id='goods{{$val->id}}' style="font-size: 12px;">{{$val->like_num}}</small>赞</span>
							</div>

							<div class="content">
								@if( !empty($val->replyInfo))
									<div class="reply-quote-box" style="background-color: #fbfbfb;border: 1px solid #efebeb;margin: 10px 0;padding: 15px 22px;">
								                      <p class="quote-time" style="color: #999;line-height: 24px;">{{$val->replyInfo->user_name}} 发表于  {{date('Y.m.d H:i:s',strtotime($val->replyInfo->created_at))}}</p>
								                      <p class="quote-con" style="color: #999;line-height: 24px;">{!!$val->replyInfo->content!!}</p>
								           </div>
								@endif
								{!!$val->content!!}
							</div>

							<div class="bottom">
								@if(!empty(session('userInfo')) && 0 == $val->is_like)
									<p id='addlike{{$val->id}}' style="height: 30px;width: 30px;text-align: center;line-height: 28px;color: #03978b;position: absolute;display: none;">+1</p>
									<a href="javascript:void(0)" class="goods" article_id="{{$val->id}}" ><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 点赞</a>
									<small style="color: #d6d6d6;margin: 0 10px;color: #999">|</small> 
								@endif
									<a href="javascript:void(0);" reply_id='{{$val->id}}' class="reply_comment scroll"><i class="fa fa-comment-o"></i> 回复</a>
							</div>

						</div>
					</div> 
					@endforeach
					<div class="topic-detail-page" style="margin-top: 6px;text-align: right;">
						   {{ $replylist->links() }}
					</div>
					
				</div>

				<div class="reply-editor">
					<form action="javascript:;" id="reply">
						<div class="reply-editor-content">
							<div class="title">回复</div>
							<input type="hidden" id="maxPage" value="{{$maxPage}}">
							<input type="hidden" id="parent_id" name="parent_id" value="{{$id}}">
							<input type="hidden" id="reply_id" name="reply_id" value="0">
							<div class="content">
								<script id="pubContent" name="content" type="text/plain"></script>
							</div>
							<div class="reply-btn">
								<button>回复</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="footer">
			<p>粤ICP备17024526号-1</p>
		</div>		
	</div>

	<script src="/scripts/lib/jquery/jquery.min.js"></script>
	<script src="/scripts/lib/UEedtor/ueditor.config.js"></script>
	<script src="/scripts/lib/UEedtor/ueditor.all.min.js"></script>
	<script src="/scripts/public/tools.js"></script>
	<script src="/scripts/public/topNav.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	<script src="/style/admin/lib/layer/2.4/layer.js"></script>
	<script src="/scripts/public/SideTop.js"></script>
	<script src="/scripts/thread.js"></script>

</body>
</html>



