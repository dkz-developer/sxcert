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
			<!-- <div class="text-c">
				<form action="/admin/infoList" method="get">
					<span class="select-box inline">
					<select name="index" class="select">
						<option value="1">ID</option>
						<option value="2">用户名</option>
						<option value="3">创建时间</option>
						<option value="4">更新时间</option>
					</select>
					</span>
					日期范围：
					<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;" name="start_time">
					-
					<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;" name="end_time">
					<input type="text" name="keyword" id="" placeholder=" 关键字" style="width:250px" class="input-text">
					<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资料</button>
				</form>
			</div> -->
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<!-- <span class="l"> -->
				<!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> -->
				 <a class="btn btn-primary radius" data-title="添加资讯" _href="article-add.html" onclick="article_add('添加资料','/admin/adda',400,300)" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a>
				</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
							<th width="50">ID</th>
							<th width="60">用户名</th>
							<th width="80">创建时间</th>
							<th width="80">更新时间</th>
							<th width="80">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list as $val)
							<tr class="text-c">
								<!-- <td><input type="checkbox" value="{{$val->id}}" name=""></td> -->
								<td>{{$val->id}}</td>
								<td>{{$val->user_name}}</td>
								<td >{{$val->created_at}}</td>
								<td>{{$val->updated_at}}</td>
								<td class="f-14 td-manage">
								<a style="text-decoration:none" onClick="modifyPassword(this,{{$val->id}})" href="javascript:;" >
									修改密码
								</a>
								<a style="text-decoration:none" onClick="article_del(this,{{$val->id}})" href="javascript:;" >
									删除
								</a>
								</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			{{$list->links()}}
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

/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url,
		 area: ['800px', '400px']
	});
	//layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url+'?id='+id
	});
	layer.full(index);
}
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(){
		$.ajax(
			{
				headers: {
		    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    		},
				type: 'POST',
				url: '/admin/dlAdmin',
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
function datadel(){
	layer.confirm('确认要删除吗？',function(){
	  	var ids = '';
	  	$('input[type=checkbox]:checked').each(function(){
	  		ids += $(this).val() + ',';
	  	})
	  	ids = ids.substring(0,ids.length-1);
	    	$.ajax(
		    	{
			    	headers: {
			    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    	},
			    	type: 'POST',
			    	url: '/admin/delInfo',
				dataType: 'json',
				data: {'ids':ids},
				success: function(result){
					if(result.code='S'){
						$('input[type=checkbox]:checked').parents('tr').remove();
						layer.msg(result.msg,{icon:1,time:2000});
					}else {
						layer.msg(result.msg,{icon:2,time:2000});
					}
				} 
			}
		);
	});
}

/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function modifyPassword(obj,id){
	layer.prompt({title: '修改密码', formType: 3}, function(password, index) {
	  	layer.close(index);
	  	$.ajax({
			headers: {
	    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    		},
			type: 'POST',
			url: '/admin/mpass',
			data: {'password':password,'id':id},
			dataType: 'json',
			success: function(data){
				if(data.code == 'S') {
					$(obj).remove();
					layer.msg(data.msg,{icon:1,time:2000});
				}else {
					layer.msg(data.msg,{icon:2,time:2000});
				}
			},
			error:function(data) {
				layer.msg('好抱歉，系统出错了，请联系网站管理员！',{icon:2,time:3000});
			},
		});		
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});
	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}
</script>