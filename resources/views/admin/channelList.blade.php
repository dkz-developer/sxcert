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
            <div class="cl pd-5 bg-1 bk-gray mt-20">
             
                 <a class="btn btn-primary radius" data-title="添加频道" _href="article-add.html" onclick="add_channel('添加频道')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加频道</a>
                </span>
            </div>
            <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                        <tr class="text-c">
                            <!-- <th width="25"><input type="checkbox" name="" value=""></th> -->
                            <th width="50">ID</th>
                            <th width="60">频道名</th>
                            <th width="80">创建时间</th>
                            <!-- <th width="80">更新时间</th> -->
                            <th width="80">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $val)
                            <tr class="text-c">
                                <!-- <td><input type="checkbox" value="{{$val->id}}" name=""></td> -->
                                <td>{{$val->id}}</td>
                                <td>{{$val->theme_name}}</td>
                                <td >{{$val->created_at}}</td>
                                <!-- <td>{{$val->updated_at}}</td> -->
                                <td class="f-14 td-manage">
                                <a style="text-decoration:none" onClick="edit_channel('编辑频道名',{{$val->id}})" href="javascript:;" >
                                    编辑
                                </a>
                                <a style="text-decoration:none" onClick="del_channel(this,{{$val->id}})" href="javascript:;" >
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

function add_channel(title){
    layer.prompt({title: title, formType: 3}, function(channel_name, index) {
        layer.close(index);
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: 'POST',
            url: '/admin/article/addChannel',
            data: {'channel_name':channel_name},
            dataType: 'json',
            success: function(data){
                if(data.code == 'S') {
                    layer.msg(data.msg,{icon:1,time:2000});
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
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

function edit_channel(title,id){
    layer.prompt({title: title, formType: 3}, function(channel_name, index) {
        layer.close(index);
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: 'POST',
            url: '/admin/article/editChannel',
            data: {'channel_name':channel_name,'id':id},
            dataType: 'json',
            success: function(data){
                if(data.code == 'S') {
                    layer.msg(data.msg,{icon:1,time:2000});
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
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

function del_channel(obj,id){
    layer.confirm('确认要删除吗？',function(){
        $.ajax(
            {
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type: 'POST',
                url: '/admin/article/delChannel',
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