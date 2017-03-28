/**
 * 顶部导航JS文件
 * @authors KYZ
 * @date    2017-02-23 10:10:28
 */

define(['jquery','tools',"login"], function($,tools,login){

    var topNav = {

        organizationCode: function(type) {
            var className = type === "index" ? "top-nav-index" : "top-nav-index";

            var _topNav_code =  '<nav class="top-nav '+className+'">'+
                '<div class="inner">'+
                '   <div class="logo"><a href="//pwww.kolstore.com" alt="领库-kolstore-社交自媒体广告平台,微博微信营销" title="领库-kolstore-社交自媒体广告平台,微博微信营销"></a></div>'+
                '	<div class="fun-shop">'+
                '		<a class="login-btn" href="javascript:void(0)" rel="nofollow">登录</a>'+
                '		<a class="register-btn" href="/register.php" rel="nofollow" target="_blank">注册</a>'+
                '	</div>'+
                '	<div class="nav-items">'+
                '		<ul>'+
                '			<li class="item" data-mark="kolrank"><a href="/">KOLRank</a></li>'+
                '           <li class="item" data-mark="kolcase"><a href="//pwww.kolstore.com/dynamic/">广告主</a></li>'+
                '           <li class="item" data-mark="aboutkol"><a href="//pwww.kolstore.com/wemedia/">自媒体</a></li>'+
                '			<li class="item" data-mark="case"><a href="//pwww.kolstore.com/case/">成功案例</a></li>'+
                '			<li class="item" data-mark="aboutus"><a href="//pwww.kolstore.com/about/">关于我们</a></li>'+
                '		</ul>'+
                '	</div>'+
                '</div>'+
                '</nav>';

            return _topNav_code;
        },

        eventListening: function(type) {
            // 滚动条监听
            $(window).scroll(function() {
                if($(window).scrollTop() > 100){
                    $topNav.addClass("top-nav-move");
                }else{
                    $topNav.removeClass("top-nav-move");
                }
            });
            $(window).ready(function() {
                if($(window).scrollTop() > 100){
                    $topNav.addClass("top-nav-move");
                }else{
                    $topNav.removeClass("top-nav-move");
                }
            })


            // 根据type点亮相应的菜单项
            $topNav.find(".nav-items").find("[data-mark='"+type+"']").addClass("active");

            // 如果用户已经登录
            var USERTYPE = $.mytools.getCookie("Type");
            var USERNAME = $.mytools.getCookie("UserName");

            var _login_btn = $(".login-btn");    // 登录按钮


            _login_btn.click(function(event) {

                if(USERTYPE && USERTYPE === "1" && USERNAME){
                    window.location.href=""+$.mytools.rankRequestUrl+"/company/choose_opinionLeaders.php?olt=weixin";
                } else {
                    login._init("company");
                }
            });

            if (USERTYPE && USERTYPE === "1" && USERNAME) {
                // 广告主已登陆
                $topNav.find(".fun-shop").empty().append('<a class="enter-btn" href="'+$.mytools.rankRequestUrl+'/company/choose_opinionLeaders.php?olt=weixin" rel="nofollow" >进入广告主平台</a>');
                if($(".login-shop").size() > 0){
                    $(".login-shop").hide();
                    $(".banner").height($(".banner").height() - 50);
                    $(".banner-item").height($(".banner-item").height() - 40);
                    $(".banner-item.static-banner").find("img").height($(".banner-item").height()); // 非层级banner图 需要static-banner类名
                }

            } else if (USERTYPE && USERTYPE === "0" && USERNAME) {
                // 意见领袖
                // window.location.href = "/kol/";
                $topNav.find(".fun-shop").empty().append('<a class="enter-btn" href="'+$.mytools.rankRequestUrl+'/kol/" rel="nofollow" >进入自媒体平台</a>');
                if($(".login-shop").size() > 0){
                    $(".login-shop").hide();
                    $(".banner").height($(".banner").height() - 50);
                    $(".banner-item").height($(".banner-item").height() - 40);
                    $(".banner-item.static-banner").find("img").height($(".banner-item").height());
                }
            }
        },

        render: function(type) {
            var code = this.organizationCode(type);

            // 写入页面 - 获取容器
            var container = $(".container").size() > 0 ? $(".container") : $("body");
            container.prepend(code);
            $topNav = container.find(".top-nav");

            // 加载事件
            this.eventListening(type);
        }

    }

    return topNav;


});









