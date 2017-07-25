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
				<form action="/admin/userList" method="get">
					<span class="select-box inline">
					<select name="index" class="select">
						<option value="0">全部</option>
						<option value="1">ID</option>
						<option value="2">用户名</option>
						<option value="3">手机号</option>
					</select>
					</span>
					日期范围：
					<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;" name="start_time">
					-
					<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;" name="end_time">
					<input type="text" name="keyword" id="" placeholder=" 关键字" style="width:250px" class="input-text">
					<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资料</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量修改金币</a> -->
				<!-- <a class="btn btn-primary radius" data-title="添加资讯" _href="article-add.html" onclick="article_add('添加资料','/admin/addInfo')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资料</a> -->
				</span>
				<span class="r">共有数据：<strong>{{$count}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
							<th width="50">ID</th>
							<th width="60">用户名</th>
							<th width="80">邮箱</th>
							<th width="80">创建时间</th>
							<th width="80">余额</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list as $val)
							<tr class="text-c">
								<!-- <td><input type="checkbox" value="{{$val->id}}" name=""></td> -->
								<td>{{$val->UserId}}</td>
								<td>{{$val->UserName}}</td>
								<td >{{$val->UserEmail}}</td>
								<td>{{$val->CreateTime}}</td>
								<td id="blance{{$val->UserId}}">{{number_format($val->Balance)}}</td>
								<td class="f-14 td-manage"><a style="text-decoration:none" onClick="change_money('修改金币',{{$val->UserId}})" title="是否热门">修改金币</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			{{$list->links()}}
		</article>
<!-- <footer class="footer">
	<p>感谢云华大大、艳周大大、宣州大大.<br> 本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">dkx团队</a>提供技术支持</p>
</footer> -->
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

function change_money(title,id){
	layer.prompt({title: title, formType: 3}, function(balance, index) {
	  	layer.close(index);
	  	$.ajax({
			headers: {
	    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    		},
			type: 'POST',
			url: '/admin/changeMoney',
			data: {'balance':balance,'id':id},
			dataType: 'json',
			success: function(data){
				if(data.code == 'S') {
					$('#blance'+id).html(data.data);
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

</script>