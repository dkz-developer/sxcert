<link rel="stylesheet" type="text/css" href="/style/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/style/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/style/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/style/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/style/admin/static/h-ui.admin/css/style.css" />
<div class="mt-20">
	<table class="table table-border table-bordered table-bg table-hover table-sort">
		<thead>
			<tr class="text-c">
				<th width="40">ID</th>
				<th width="100">内容</th>
				<th width="50">点赞数</th>
				<th width="50">回复数</th>
				<th width="80">发布时间</th>
				<th width="80">用户名</th>
				<th width="50">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($list as $val)
			<tr class="text-c">
				<td>{{$val->id}}</td>
				<td>{{$val->content}}</td>
				<td>{{$val->like_num}}</td>
				<td>{{$val->reply_num}}</td>
				<td>{{$val->created_at}}</td>
				<td>{{$val->user_name}}</td>
				<td class="f-14 td-manage">
					<a style="text-decoration:none" class="ml-5" onClick="del_reply(this,{{$val->id}})" href="javascript:;" title="删除">删除</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<script type="text/javascript" src="/style/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/style/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/style/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/style/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script> 
<script type="text/javascript">
	function del_reply(obj,id){
		layer.confirm('确认要删除吗？',function(){
			$.ajax(
				{
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: 'GET',
					url: '/admin/article/delReply?id='+id,
					//data: {'id':id},
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