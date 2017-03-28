/**
 * 入口(公用)JS文件
 * @authors KYX
 * @date 	2017-2-24 12:52:26
 */

(function(){

	// ****************
	// *  requireJs 的配置
	// ****************
	require.config({
		baseUrl: 'scripts/min',

		paths: {
			// 依赖包
			jquery: 'lib/jquery/jquery.min', // jQuery
			jsonp: 'lib/jquery/jquery.jsonp', // jQuery
			is: 'lib/is-js/is.min',	//is文件
			echarts: 'lib/echarts/echarts.min', //  现状图插件
			svg3dtagcloud: 'lib/svg3dtagcloud/jquery.svg3dtagcloud.min', //  kolrank粉丝变标签插件
			kkpager:'lib/kkpager/kkpager.min', //分页插件
			vue:'lib/vue/vue.min', //vue
			popover: 'lib/popover/jquery.webui-popover', // popover

			// 公共包
			tools: 'public/tools', // 工具包
			kolDialog: 'public/kolDialog', //弹出框
			login: 'public/login', // 登录框
			topNav: 'public/topNav', // 顶部导航
			footer: 'public/footer', // 底部

			// rank页
			index: 'kolrank/index', // 首页
			ranklist: 'kolrank/ranklist', // 列表页
			accountInfo_weixin: 'kolrank/accountInfo_weixin', // 微信详情页
			accountInfo_weibo: 'kolrank/accountInfo_weibo', // 微博详情页
			articlelist: 'kolrank/articlelist', // 文章列表页
		},
		shim: {
			kolDialog:{
				deps:["jquery","tools"],
				exports: 'kolDialog'
			},
			kkpager:{
				deps:["jquery"],
				exports: 'kkpager'
			},
		},

	});

	define(['jquery'], function($){

		// 根据页面类型进行JS文件分发加载
		var _page_type = $(".container").attr("data-page-type");
		require([_page_type]);
	});

})()