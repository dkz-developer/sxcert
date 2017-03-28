/**
 * 首页JS文件
 * @authors KYX
 * @date 	2017-2-24 12:52:26
 */

define(['jquery','vue','tools','topNav','footer','popover'], function($,Vue,tools,topNav,footer,popover){

    $(function(){


        // 实例化vue
        var vm = new Vue({
            el: '#app',
            data: {
                weiboWeekList: [{}],
                weiboMonthList: [{}],
                DropDown_show: false,
                DateDefault_text: "微信公众号",
                DateDefault_mark: "2",
            },
            methods: {
            getDropDown: getDropDown, // 时间下拉框
            changeDropDown: changeDropDown, // 下拉框更新值
            search: search, // 搜索
            }
        });
 
        //  榜单详细信息展示
        function showDetailedInfo(){
            $(".rank-list-content").delegate('div.data', "mouseenter", function (event) {  
                $(this).parents(".rank-list-content").find('div.data').removeClass('detailed').addClass('simplify');
                $(this).removeClass('simplify').addClass('detailed');
            }).delegate("div.data", "mouseleave", function (event) {  
                $(this).addClass('simplify');
            });
        };

        // 下拉框
        function getDropDown() {
            if(vm.DropDown_show == true) {
                vm.DropDown_show = false;
            }else {
                vm.DropDown_show = true;
            }
        }

         // 下拉框更新值
        function changeDropDown(event) {
            var text =  $(event.currentTarget).text();
            var value = $(event.currentTarget).attr("data-mark");
            var button = $(event.currentTarget).parents(".options").find("button em");
            button.text(text);
            button.attr("data-mark",value);
            vm.DropDown_show = false;
        }

        function search() {

            var keyword = $(".search-input").val(); // 关键字
            var media = $(".search").find("em").attr("data-mark") == "2" ? "weixin" : "weibo";
            var type = media == "weixin" ? "day" : "week";

            if(keyword) {
                window.location.href ='/ranklist?media='+media+'&type='+type+'&keyword='+keyword;
            }else {
                return false;
            }
        }

        // 请求接口加载微博数据
        function requestInterface_weibo(setting) {

            var weiboClassId = setting && setting.weiboClassId ? setting.weiboClassId : "0";

            var params = {
                "_token": $("#app").attr("data-value"),
                "weiboClassId": weiboClassId
            }

            $.post('/WeiboHotList', params, function(backData) {

                if(backData && backData.code === "S") {
                    vm.weiboWeekList = backData.weiboWeekList;
                    vm.weiboMonthList = backData.weiboMonthList;
                }
            }, "json"); 
        };

        
        // 事件绑定
        function bindEvents() {

            // 分类查询
            $(".rank-class-menu").find("li").click(function() {
                var _classid = $(this).attr("data-classid");
                var _media = $(this).parents(".rank-class-menu").attr("data-media");

                $(this).parents(".rank-class-menu").find("li").removeClass('active');
                $(this).addClass('active');

                if(_media === "weixin") {
                    requestInterface_weixin({"weixinClassId":_classid})
                }else if(_media === "weibo") {
                    requestInterface_weibo({"weiboClassId":_classid})
                };
            });

            // 微信KCI指数说明
            var wxKCIHelpContent = [];
            wxKCIHelpContent.push('<div class="wxKCIView">');
            wxKCIHelpContent.push(' <p>KCI指的是微信自媒体影响力指数，是领库平台用来评估微信自媒体账号影响力、活跃度、传播力的重要指标。指数范围：1-1000，指数越高表示账号质量越好。</p>');
            wxKCIHelpContent.push('</div>');
            $(".wxKCIHelp").webuiPopover({
                content: wxKCIHelpContent.join(""),
                trigger: 'hover',
            });

            // 微博KBI指数说明
            var wbKBIHelpContent = [];
            wbKBIHelpContent.push('<div class="wbKCIView">');
            wbKBIHelpContent.push(' <p>KBI指的是微博自媒体影响力指数，是领库平台用来评估微博自媒体账号影响力、传播力、用户价值的重要指标。指数范围：1-1000，指数越高表示账号质量越好。</p>');
            wbKBIHelpContent.push('</div>');
            $(".wbKBIHelp").webuiPopover({
                content: wbKBIHelpContent.join(""),
                trigger: 'hover',
            });
        };


        $(function(){

            // 加载顶部导航条
            topNav.render("kolrank");

            // 加载脚部信息条
            footer.render();

            showDetailedInfo();
            
            // 请求接口加载微博数据
            requestInterface_weibo();

            // 事件绑定
            bindEvents();


            


        });

    })

});


