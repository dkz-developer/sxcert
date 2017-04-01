@extends('admin._parent')
@section('content')
<style type="text/css">
	.text-c{
		margin-top: 2em;
		height: 50px;
		overflow: hidden;
		width: 100%;
	}
	.text-c form{
		float:right;
	}
	.pagination{
		float: right;
		margin-bottom: 50px;
	}
	.pagination li{
		float: left;
		margin-left: 10px;
	}
	.pagination .active{
		color:#5eb95e;
	}
</style>
   <article class="cl pd-20">
			<div class="text-c">
				<form class="Huiform" method="post" action="javascript:void(0);" target="_self" id="addCommon">
					<input placeholder="品牌名称" value="" class="input-text" style="width:120px" type="text" name="name">
					<input type="hidden" name="type" value="1">
					</span><button type="submit" class="btn btn-success" id="" onclick="add_common('#addCommon')" name=""><i class="Hui-iconfont"></i> 添加</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				</span>
				<span class="r">共有数据：<strong>{{$brandCount}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>品牌名</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($brand as $val)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$val->id}}</td>
							<td>{{$val->name}}</td>
							<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $brand->links() }}
			</div>

			<div class="text-c">
				<form class="Huiform" method="post" action="javascript:void(0)" target="_self" id="addmodel">
					<input placeholder="机型名称" value="" class="input-text" style="width:120px" type="text" name="name">
					<input type="hidden" name="type" value="2">
					</span><button type="submit" class="btn btn-success" id="" name="" onclick="add_common('#addmodel')"><i class="Hui-iconfont"></i> 添加</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				</span>
				<span class="r">共有数据：<strong>{{$modelCount}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>机型</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($model as $val)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$val->id}}</td>
							<td>{{$val->name}}</td>
							<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $model->links() }}
			</div>

			<div class="text-c">
				<form class="Huiform" method="post" action="javascript:void(0)" target="_self" id="add_country">
					<input placeholder="国家名称" value="" class="input-text" style="width:120px" type="text" name="name">
					<input type="hidden" name="type" value="3">
					</span><button type="button" class="btn btn-success" id="" name="" onclick="add_common('#add_country');"><i class="Hui-iconfont"></i> 添加</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				</span>
				<span class="r">共有数据：<strong>{{$countryCount}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>国家</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($country as $val)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$val->id}}</td>
							<td>{{$val->name}}</td>
							<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $country->links() }}
			</div>

			<div class="text-c">
				<form class="Huiform" method="post" action="javascript:void(0)" target="_self" id="add_os">
					<input placeholder="OS" value="" class="input-text" style="width:120px" type="text" name="name">
					<input type="hidden" name="type" value="4">
					</span><button type="button" class="btn btn-success" id="" name="" onclick="add_common('#add_os');"><i class="Hui-iconfont"></i> 添加</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				</span>
				<span class="r">共有数据：<strong>{{$osCount}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>OS</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($os as $val)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$val->id}}</td>
							<td>{{$val->name}}</td>
							<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $os->links() }}
			</div>

			<div class="text-c">
				<form class="Huiform" method="post" action="javascript:void(0)" target="_self" id="add_type">
					<input placeholder="类型" value="" class="input-text" style="width:120px" type="text" name="name">
					<input type="hidden" name="type" value="5">
					</span><button type="button" class="btn btn-success" id="" name="" onclick="add_common('#add_type');"><i class="Hui-iconfont"></i> 添加</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				</span>
				<span class="r">共有数据：<strong>{{$typeCount}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>类型</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($type as $val)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$val->id}}</td>
							<td>{{$val->name}}</td>
							<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $type->links() }}
			</div>

			<div class="text-c">
				<form class="Huiform" method="post" action="javascript:void(0)" target="_self" id="add_tag">
					<input placeholder="标签" value="" class="input-text" style="width:120px" type="text" name="name">
					<input type="hidden" name="type" value="6">
					</span><button type="button" class="btn btn-success" id="" name="" onclick="add_common('#add_tag');"><i class="Hui-iconfont"></i> 添加</button>
				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				</span>
				<span class="r">共有数据：<strong>{{$tagCount}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>标签</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($tag as $val)
						<tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td>{{$val->id}}</td>
							<td>{{$val->name}}</td>
							<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_stop(this,'10001')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'10001')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{{ $tag->links() }}
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
function add_common(obj) {
	var param = $(obj).serialize();
	$.ajaxSetup(
		{
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:"/admin/commonAdd",
			data:param,
			dataType:'json',
			type:'post',
			success:function(result) {
				if(result.code == 'S') {
					layer.tips(result.msg, $(obj), {
						tips: [1, '#3595CC'],
						time: 4000
					});
				}else {
					layer.tips(result.msg, $(obj), {
						tips: [1, '#FF0000'],
						time: 4000
					});
				}
			}
		}
	);
	$.ajax();
	return false;
}
</script>