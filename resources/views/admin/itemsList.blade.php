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
        <form action="/admin/service/items" method="get">
            日期范围：
            <input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;" name="startime" value="{{$_GET['startime'] or ''}}">
            -
            <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;" name="endtime" value="{{$_GET['endtime'] or ''}}">
            <input type="text" name="title" id="" placeholder="项目名" style="width:250px" class="input-text" value="{{$_GET ['title'] or ''}}">
            <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜服务项目</button>
        </form>
            
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l">
            <!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> -->
            <a class="btn btn-primary radius" data-title="添加服务项目" _href="article-add.html" onclick="article_add('添加服务项目','/admin/add/items')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加服务项目</a>
            </span>
            <span class="r">共有数据：<strong>{{$count}}</strong> 条</span>
        </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-bg table-hover table-sort">
                <thead>
                    <tr class="text-c">
                        <!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
                        <th width="40">ID</th>
                        <th width="130">服务项目</th>
                        <th width="90">类型</th>
                        <th width="60">所需时间</th>
                        <th width="45">价格</th>
                        <th width="70">添加时间</th>
                        <th width="70">更新时间</th>
                        <th width="120">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $val)
                    <tr class="text-c">
                        <!-- <td><input type="checkbox" value="" name=""></td> -->
                        <td>{{$val->id}}</td>
                        <td class="text-l"><a style="cursor:pointer" class="text-primary" href="/thread/topic/{{$val->id}}" title="查看" target="_blank">{{$val->title}}</a></td>
                        <td>{{$val->type}}</td>
                        <td>{{$val->need_date}}</td>
                        <td>{{$val->price}}</td>
                        <td>{{$val->create_time}}</td>
                        <td>{{$val->update_time}}</td>
                        
                     
                        <td class="f-14 td-manage">
                            <a style="text-decoration:none" class="ml-5" onclick="article_add('编辑项目', '/admin/add/items?id={{$val->id}}')" href="javascript:;" title="编辑">编辑</a>
                            <a style="text-decoration:none" class="ml-5" onClick="del_article(this,{{$val->id}})" href="javascript:;" title="删除">删除</a>
                        </td>
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

function article_add(title, url)
{
    var index = layer.open({
        type: 2,
        title: title,
        content: url
    });
    layer.full(index);
}

$('.table-sort').dataTable({
    "aaSorting": [[ 1, "desc" ]],//默认第几个排序
    "bStateSave": true,//状态保存
    "aoColumnDefs": [
        //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
        {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
    ]
});




function del_article(obj,id){
    layer.confirm('确认要删除吗？',function(){
        $.ajax(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/admin/delitems',
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

function show_reply(obj,id)
{
    layer_show('查看回帖','/admin/article/replyList?id='+id,800,600);
}
</script>