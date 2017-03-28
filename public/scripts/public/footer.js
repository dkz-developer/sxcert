/**
 * 底部JS文件
 * @authors KYZ
 * @date    2017-02-23 10:10:28
 */

define(['jquery'], function($){

    // 组织代码
    function organizationCode(){

        var _footer_code =  '<div class="footer">'+
            '<div class="content">'+
            '	<div class="product">'+
            '		<h2>产品介绍</h2>'+
                //'		<a href="###" target="_blank">KOLStore</a>'+
                //'		<a href="###" target="_blank">KOLRank</a>'+
            '		<a href="/dynamic/" target="_blank">广告主</a>'+
            '		<a href="/wemedia/" target="_blank">自媒体</a>'+
            '		<a href="/kolrank/" target="_blank">KolRank</a>'+
            '	</div>'+
            '	<div class="aboutus">'+
            '		<h2>关于我们</h2>'+
            '		<a href="/about/" target="_blank">公司介绍</a>'+
                //'		<a href="/register.php" target="_blank">加入我们</a>'+
            '		<a href="/about/#information" target="_blank">领库资讯</a>'+
            '	</div>'+
            '	<div class="servicecenter">'+
            '		<h2>服务中心</h2>'+
            '		<a href="/help/">帮助中心</a>'+
            '		<a href="/help/#guarantee" class="guarantee">服务保障</a>'+
            '		<a href="/notice/">法律声明</a>'+
            '	</div>'+
            '	<div class="contact">'+
            '		<p class="hotline">全国服务热线<a href="tel:400-000-6230" rel="nofollow"><em>400-000-6230</em></a></p>'+
            '		<p><a href="mailto:kol@microdreams.com" rel="nofollow">kol@microdreams.com</a></p>'+
            '		<p>北京市朝阳区广渠路3号竞园5B栋</p>'+
            '		<p>24小时服务</p>'+
            '	</div>'+
            '</div>'+
            '<div class="record">'+
            '	<p>Copyright © 2015 Microdreams Co.,Ltd. All rights reserved.&nbsp;&nbsp;&nbsp;&nbsp;北京微梦传媒股份有限公司&nbsp;&nbsp;&nbsp;&nbsp;京ICP备14018627号-2&nbsp;&nbsp;&nbsp;&nbsp;京ICP证151155号</p>'+
            '	<p>京公网安备 11010502030283号</p>'+
            '</div>'+
            '</div>'+
            '<script>'+
            '   var _hmt = _hmt || [];'+
            '   (function() {'+
            '       var hm = document.createElement("script");'+
            '       hm.src = "//hm.baidu.com/hm.js?fea2280e19fa5e87d45b28fee3aaf1f9";'+
            '       var s = document.getElementsByTagName("script")[0]; '+
            '       s.parentNode.insertBefore(hm, s);'+
            '   })();'+
            '</script>'+
                /*'<script>'+
                 '   (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){'+
                 '   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),'+
                 '   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)'+
                 '   })(window,document,"script","//www.google-analytics.com/analytics.js","ga");'+
                 '   ga("create", "UA-70490768-1", "auto");'+
                 '   ga("send", "pageview");'+
                 '</script>'+*/
            '<script src="https://s4.cnzz.com/z_stat.php?id=1257125375&web_id=1257125375" language="JavaScript"></script>';

        return _footer_code;
    }

    // 加载事件
    function eventListening(){

    }

    var $footer = {

        render: function(type) {
            var code = organizationCode(type);

            // 写入页面 - 获取容器
            var container = $(".container").size() > 0 ? $(".container") : $("body");
            if($(".container").size() > 0){
                container.append(code);
            }else{
                container.last().after(code);
            }
            $footer = container.find(".footer");

            // 加载事件
            eventListening();

            $(".guarantee").click(function() {
                window.top.location.href = "/help/#guarantee";
                window.location.reload();
            });
        }

    }

    return $footer;


});
