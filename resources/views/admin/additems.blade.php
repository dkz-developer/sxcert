<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="Bookmark" href="favicon.ico" >
<link rel="Shortcut Icon" href="favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/style/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/style/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/style/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/style/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/style/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->
<link href="/style/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<title>新增文章 - 资讯管理 - H-ui.admin v3.0</title>
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
    <form class="form form-horizontal" id="form-article-add" action="javascript:void(0)">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>服务项目：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$info->title or ''}}" placeholder="" id="" name="title">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>类型：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$info->type or ''}}" placeholder="" id="" name="type">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所需时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$info->need_date or ''}}" placeholder="" id="" name="need_date">
            </div>
        </div>
         <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>价格：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$info->price or ''}}" placeholder="" id="" name="price">
            </div>
        </div>
     
        @if(!empty($info) && $info->id)
            <input type="hidden" name="id" value="{{$info->id}}">
        @endif
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">内容：</label>
            <div class="formControls col-xs-8 col-sm-9"> 
                <script id="content" type="text/plain" style="width:100%;height:400px;">{!!$info->content or ''!!}</script> 
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
                <!-- <button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button> -->
                <button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/style/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/style/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/style/admin/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="/style/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script> 
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/style/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/style/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/style/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/style/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>   
<script type="text/javascript" src="/style/admin/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="/style/admin/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="/style/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="/style/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
$(function(){
    var ue = UE.getEditor('content');
});
$('#form-article-add').submit(function(){
    var param = $(this).serialize();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/admin/additemsHandle",
        data:param,
        dataType:'json',
        type:'post',
        success:function(result) {
            if(result.code == 'S') {
                layer.alert(result.msg, {
                    icon: 1,
                    skin: 'layer-ext-moon' 
                })
            }else {
                layer.alert(result.msg, {
                    icon: 2,
                    skin: 'layer-ext-moon' 
                })
            }
        }
    });
    $.ajax();
    return false;
});

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>