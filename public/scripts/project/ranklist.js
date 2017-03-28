/**
 * rank排名JS文件
 * @authors KYX
 * @date 	2017-2-24 12:52:26
 */

define(['jquery','vue','tools','kolDialog','topNav','footer','popover','kkpager'], function($,Vue,tools,kolDialog,topNav,footer,popover,kkpager){
	$(function(){

		var _media = $.mytools.GetQueryString("media");	// 平台
		var _type = $.mytools.GetQueryString("type");	// 榜单类型 日 周 月
		var keyword = $.mytools.GetQueryString("keyword");	// 关键字

		// 实例化vue
        var vm = new Vue({
            el: '#app',
            data: {
                rankList: [{}], // rank列表数据
                classList: [{}], // 菜单列表数据
                State: _media == "weibo" ? "1" : "2", // 当前查询
                DateDefault_text: _media == "weibo" ? "周榜" : "日榜",
                DateDefault_mark: _media == "weibo" ? "2" : "1",
                DropDown_show: false,
                keyword: keyword,

            },
            methods: {
            	getListByMenu: getListByMenu, // 菜单分击查询
            	getListBydate: getListBydate, // 日榜周榜月榜查询
            	getListByMedia: getListByMedia, // 微博微信切换查询
            	getDropDown: getDropDown, // 时间下拉框
            	dataState: dataState, // 微信微博数据说明
            }
        });

		// 菜单分类查询
        function getListByMenu(event) {
        	var classid = event.currentTarget.getAttribute("data-classid");
            $(".class-menu").find("li").removeClass("active");
			$(event.currentTarget).addClass("active");
			requestInterface({"classId" : classid});
        }

        // 周榜月榜日榜查询
        function getListBydate(event) {
        	var rankType = event.currentTarget.getAttribute("data-mark");
            $(".class-menu").find("li").removeClass("active");
			$(event.currentTarget).addClass("active");
			requestInterface({"refreshclass" : true,"rankType" : rankType});

			// 动态改变日周月榜值
			vm.DateDefault_text = $(event.currentTarget).text();
			vm.DateDefault_mark = $(event.currentTarget).attr("data-mark");
        	vm.DropDown_show = false;
        }

        // 微博微信切换查询
        function getListByMedia(event) {
        	var media = event.currentTarget.getAttribute("data-mark");
            $(".inner").find("span[data-mark]").removeClass("active");
			$(event.currentTarget).addClass("active");
			requestInterface({"refreshclass" : true,"media" : media});
			vm.State = media;
			if(media == "1") {
				vm.DateDefault_text = "周榜";
				vm.DateDefault_mark = "2";
			}else {
				vm.DateDefault_text = "日榜";
				vm.DateDefault_mark = "1";
			}
        }

        // 时间下拉框
        function getDropDown() {
        	
        	if(vm.DropDown_show == true) {
                vm.DropDown_show = false;
            }else {
                vm.DropDown_show = true;
            }
        }

        // 请求接口加载列表数据
        function requestInterface(setting) {

            var params = {
                "_token": $("#app").attr("data-value"),
                "media": setting && setting.media ? setting.media : $(".nav").find(".active").attr("data-mark"),
                "rankType": setting && setting.rankType ? setting.rankType : $(".rank-type").find("em").attr("data-mark"),
                "classId": setting && setting.classId ? setting.classId : "",
                "all": !setting.classId || setting.classId == "all" ? "1" : "0",
                "page": setting && setting.page ? setting.page : "1",
                "limit": "25",
                "keyword": keyword ? keyword : ""
            };

            $.post('/RankListData', params, function(backData) {

                if(backData && backData.code === "S") {

                    vm.rankList = backData.rows;

                    if(setting.refreshclass) {
                    	vm.classList = backData.classList;
                    }

                    createSplitPage(backData);

                }

            }, "json"); 
        };

        // 微信微博数据说明
        function dataState() {
			$.get("/state", {}, function(backData) {
				if(backData){
					var login_dialog = $.kolDialog({
						"title": "数据说明",
						"content": backData,
						"background": "fff"
					});
				};
				//处理弹出层样式
				var height_main = $(".kol-dialog-main").height();
				var height_content = $(".kol-dialog-content").height();

				$(".kol-dialog-main").height(height_main - 100);
				$(".kol-dialog-content").height(height_content - 100);
				$(".kol-dialog-main").css("top","105px");

				$(".stateInfo-closebtn").find("button").click(function() {
					$(".kol-dialog-main").addClass("slideOutDown");
					$(".kol-dialog").addClass("fadeOut");
					setTimeout('$(".kol-dialog").remove();',600);
				});
			}, "html");
        }

		// 事件绑定
        function bindEvents() {

			// 微博KBI指数说明
			var wbKBIHelpContent = [];
			wbKBIHelpContent.push('<div class="wbKCIView">');
			wbKBIHelpContent.push('	<p>KBI指的是微博自媒体影响力指数，是领库平台用来评估微博自媒体账号影响力、传播力、用户价值的重要指标。指数范围：1-1000，指数越高表示账号质量越好。</p>');
			wbKBIHelpContent.push('</div>');
			$("#wbKBIHelp").webuiPopover({
				content: wbKBIHelpContent.join(""),
				trigger: 'hover',
			});

			// 微信KCI指数说明
			var wxKCIHelpContent = [];
			wxKCIHelpContent.push('<div class="wbKCIView">');
			wxKCIHelpContent.push('	<p>KCI指的是微信自媒体影响力指数，是领库平台用来评估微信自媒体账号影响力、活跃度、传播力的重要指标。指数范围：1-1000，指数越高表示账号质量越好。</p>');
			wxKCIHelpContent.push('</div>');
			$("#wxKCIHelp").webuiPopover({
				content: wxKCIHelpContent.join(""),
				trigger: 'hover',
			});
        };


        // 生成分页
		function createSplitPage(dataJson){

			var currentPage = dataJson.page;	// 当前页数
			// var totalRecords = dataJson.total	// 总条数
			var totalPage = dataJson.maxPage;	// 总页数
			// var pageSize = dataJson.pageSize; // 每页显示条数

			kkpager.generPageHtml({
				pno: currentPage,
				//总页码
				total: totalPage,
				//总数据条数
				// totalRecords: totalRecords,
				isGoPage: false,
				mode : 'click',//默认值是link，可选link或者click
				isShowLastPageBtn: true,
				isShowFirstPageBtn: true,
				click : function(n){
					//手动选中按钮
					this.selectPage(n);

					$("html").animate({scrollTop: $(".ranklist").offset().top - 100}, 50);

					// 当前页数
					var page = $("#kkpager").find(".curr").text();
					var classId = $(".class-menu").find("li.active").attr("data-classid");
					// 加载数据
					requestInterface({"page": page, "classId":classId});
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

			// 事件绑定
			bindEvents();

			requestInterface({"refreshclass": "true"});
			
		});
	})

});

