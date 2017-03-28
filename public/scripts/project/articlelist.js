/**
 * 首页JS文件
 * @authors KYX
 * @date 	2017-2-24 12:52:26
 */

define(['jquery','vue','tools','topNav','footer','kkpager'], function($,Vue,tools,topNav,footer,kkpager){

    $(function(){

		var weiboUserId = $.mytools.GetQueryString("weiboUserId");	// 微博账号ID


        // 实例化vue
        var vm = new Vue({
            el: '#app',
            data: {
                articleWeiboList: [{}], // 微博文章列表数据
            },
           
        });

       // 请求接口加载列表数据
        function requestInterface(setting) {

            var params = {
                "_token": $("#app").attr("data-value"),
                "weiboUserId": weiboUserId,
                "page": setting && setting.page ? setting.page : "1",
            };

            $.post('/MoreArticle', params, function(backData) {

                if(backData && backData.code === "S") {

                    vm.articleWeiboList = backData.article.article;

                    createSplitPage(backData.article);

                }

            }, "json"); 
        };

        // 生成分页
        function createSplitPage(dataJson){

            var currentPage = dataJson.page;    // 当前页数
            var totalPage = dataJson.maxpage;   // 总页数

            kkpager.generPageHtml({
                pno: currentPage,
                //总页码
                total: totalPage,
                isGoPage: false,
                mode : 'click',//默认值是link，可选link或者click
                isShowLastPageBtn: true,
                isShowFirstPageBtn: true,
                click : function(n){
                    //手动选中按钮
                    this.selectPage(n);

                    $("html body").animate({scrollTop: $(".account-articles").offset().top - 50}, 50);
                    $("html").animate({scrollTop: $(".account-articles").offset().top - 50}, 50);

                    // 当前页数
                    var page = $("#kkpager").find(".curr").text();
                    // 加载数据
                    requestInterface({"page": page});
                    return false;
                }
            }, true);

            // 调整分页组件的位置
            $("#kkpager").show();
            $(".pageBtnWrap").css("margin-left", (($(".pageBtnWrap").parent().width() - $(".pageBtnWrap").width()) / 2) + "px");
        }


        $(function(){

        	// 加载顶部导航条
            topNav.render("kolrank");

            // 加载脚部信息条
            footer.render();

            requestInterface();



        });
    })
});
