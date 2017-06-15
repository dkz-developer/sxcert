@extends('admin._parent')
@section('content')
<style type="text/css">
	.pagination{
		float: right;
	}
	.pagination li{
		float: left;
		margin:5px;
	}
	.pagination .active{
		color:#5eb95e;
	}
</style>

	<article class="cl pd-20">
		<div class="text-c">
		<form action="/admin/article/list" method="get">
			<span class="select-box inline">
			<select  class="select" name="theme_id">
				<option value="0">全部频道</option>
				@foreach($themeInfo as $val)

				<option value="{{$val->id}}" @if(isset($_GET['theme_id']) && $_GET['theme_id'] == $val->id) selected @endif>{{$val->theme_name}}</option>
				@endforeach
			</select>
			</span>
			日期范围：
			<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;" name="startime" value="{{$_GET['startime'] or ''}}">
			-
			<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;" name="endtime" value="{{$_GET['endtime'] or ''}}">
			<input type="text" name="title" id="" placeholder=" 文章名称" style="width:250px" class="input-text" value="{{$_GET ['title'] or ''}}">
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜文章</button>
		</form>
			
		</div>
		<div class="cl pd-5 bg-1 bk-gray mt-20">
			<span class="l">
			<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
			<!-- <a class="btn btn-primary radius" data-title="添加资讯" _href="article-add.html" onclick="article_add('添加资讯','article-add.html')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a> -->
			</span>
			<span class="r">共有数据：<strong>{{$count}}</strong> 条</span>
		</div>
		<div class="mt-20">
			<table class="table table-border table-bordered table-bg table-hover table-sort">
				<thead>
					<tr class="text-c">
						<th width="25"><input type="checkbox" name="" value=""></th>
						<th width="40">ID</th>
						<th>标题</th>
						<th width="90">频道名</th>
						<th width="40">浏览数</th>
						<th width="45">点赞数</th>
						<th width="45">回复数</th>
						<th width="130">发布时间</th>
						<th width="100">用户名</th>
						<th width="50">是否置顶</th>
						<th width="50">是否精华</th>
						<th width="200">操作</th>
					</tr>
				</thead>
				<tbody>
				  <!--   <tr class="text-c">
						<td><input type="checkbox" value="" name=""></td>
						<td>10001</td>
						<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看">资讯标题</u></td>
						<td>行业动态</td>
						<td>H-ui</td>
						<td>2014-6-11 11:11:42</td>
						<td>21212</td>
						<td class="td-status"><span class="label label-success radius">已发布</span></td>
						<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
							<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
							<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr> -->
					@foreach($list as $val)
					<tr class="text-c">
						<td><input type="checkbox" value="" name=""></td>
						<td>{{$val->id}}</td>
						<td class="text-l"><u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10002')" title="查看">{{$val->title}}</u></td>
						<td>{{$val->theme_name}}</td>
						<td>{{$val->view_num}}</td>
						<td>{{$val->like_num}}</td>
						<td>{{$val->reply_num}}</td>
						<td>{{$val->created_at}}</td>
						<td>{{$val->user_name}}</td>
						<td class="td-status" id="top_status{{$val->id}}">@if($val->is_top == 1)<span class="label label-success radius">置顶</span>@else <span class="label label-primary radius">否</span> @endif</td>
						<td class="td-status" id="brilliant_status{{$val->id}}">@if($val->is_brilliant == 1)<span class="label label-success radius">精华</span>@else <span class="label label-primary radius">否</span> @endif</td>
						<td class="f-14 td-manage"><a style="text-decoration:none" onClick="setTop('top_status',{{$val->id}},this)" href="javascript:;" title="置顶" status ="{{$val->is_top}}">@if($val->is_top == 0)置顶@else 取消置顶@endif</a>
							<a style="text-decoration:none" class="ml-5" onClick="setbrilliant('brilliant_status',{{$val->id}},this)" href="javascript:;" title="加精" status="{{$val->is_brilliant}}">@if($val->is_brilliant == 0)加精@else 取消加精 @endif</a>
							<a style="text-decoration:none" class="ml-5" onClick="del_article(this,{{$val->id}})" href="javascript:;" title="删除">删除</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
				 {{$list->links()}}
		</div>
	</article>

<footer class="footer">
	<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br> Copyright &copy;2015 H-ui.admin v3.0 All Rights Reserved.<br> 本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
</footer>
@endsection

<script type="text/javascript" src="/style/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/style/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/style/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
		//{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		{"orderable":false,"aTargets":[0,8]}// 不参与排序的列
	]
});

function setbrilliant(idElement,id,obj)
{
		var status = parseInt($(obj) .attr('status'));
		if(0 == status)
			status = 1;
		else 
			status = 0;
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			type: 'POST',
			url: '/admin/article/setBrilliant',
			data: {'id':id,'status':status},
			dataType: 'json',
			success: function(data){
				if(data.code == 'S') {
					layer.msg(data.msg,{icon:1,time:2000});
					if(1 == status) {
						$('#'+idElement+id).html('<span class="label label-success radius">精华</span>');
						$(obj).attr('status',1);
						$(obj).html('取消加精');
					}else{
						$('#'+idElement+id).html('<span class="label label-primary radius">否</span>');
						$(obj).attr('status',0);
						$(obj).html('加精');
					 }
				}else {
					layer.msg(data.msg,{icon:2,time:2000});
				}
			},
			error:function(data) {
				layer.msg('好抱歉，系统出错了，请联系网站管理员！',{icon:2,time:3000});
			},
		});     
}

function setTop(idElement,id,obj)
{
		var status = parseInt($(obj) .attr('status'));
		if(0 == status)
			status = 1;
		else 
			status = 0;
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
			type: 'POST',
			url: '/admin/article/setTop',
			data: {'id':id,'status':status},
			dataType: 'json',
			success: function(data){
				if(data.code == 'S') {
					layer.msg(data.msg,{icon:1,time:2000});
					if(1 == status) {
						$('#'+idElement+id).html('<span class="label label-success radius">置顶</span>');
						$(obj).attr('status',1);
						$(obj).html('取消置顶');
					}else{
						$('#'+idElement+id).html('<span class="label label-primary radius">否</span>');
						$(obj).attr('status',0);
						$(obj).html('置顶');
					 }
				}else {
					layer.msg(data.msg,{icon:2,time:2000});
				}
			},
			error:function(data) {
				layer.msg('好抱歉，系统出错了，请联系网站管理员！',{icon:2,time:3000});
			},
		});     
}

function del_article(obj,id){
	layer.confirm('确认要删除吗？',function(){
		$.ajax(
			{
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '/admin/article/delArticle',
				data: {'id':id},
				dataType: 'json',
				success: function(data){
					if(data.code == 'S') {
						$(obj).parents("tr").remove();
						layer.msg(data.msg,{icon:1,time:2000});
					}else {
						layer.msg(data.msg,{icon:2,time:2000});
					}
				},
				error:function(data) {
					layer.msg('好抱歉，系统好像出错了，请联系网站管理员！',{icon:2,time:3000});
				},
			}
		);      
	});
}
</script>