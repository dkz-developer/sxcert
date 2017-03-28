/**
 * 弹出框组件 kolDialog
 * @authors SX
 * @date    2015-09-22 16:26:58
 */
;(function($){

	function kolDialog(options){

		this.options = $.extend({}, pluginDefaults, options);
	}

	kolDialog.prototype = {

		_init: function(){
			this._buildHTML();	// 构建弹出框
			return {"options": this.options, "dialog_dom_obj": this.options._dialog_dom_obj, "dialog_obj": this};
		},

		// 构建弹出框
		_buildHTML: function(){
			var __icon_dom = this.options.icon ? $(this.options._html_icon).addClass(this.options.icon) : "";
			var __title_dom = this.options.title ? $(this.options._html_title).append(__icon_dom).append(this.options.title) : __icon_dom ? $(this.options._html_title).append(__icon_dom) : "";
			var __content_dom = $(this.options._html_content).append(this.options.content);
			var __footer_dom = this.options.isShow_footer ? $(this.options._html_footer) : "";

			// 脚部内容
			if(__footer_dom && __footer_dom !== ""){
				if(this.options.footerContent && this.options.footerContent !== ""){
					__footer_dom.append(this.options.footerContent);
				}else{
					var __confirmButton = '<button id="confirmButton" class="btn '+this.options.confirmButtonClass+' btn-sm">'+this.options.confirmButton+'</button>';	// 确定按钮
					var __cancelButton = '<button id="cancelButton" class="btn '+this.options.cancelButtonClass+' btn-sm">'+this.options.cancelButton+'</button>';	// 取消按钮

					if(this.options.isShowConfirmButton){
						__footer_dom.append(__confirmButton);
					}

					if(this.options.isShowCancelButton){
						__footer_dom.append(__cancelButton);
					}
				}
			}
			
			var __main_dom = $(this.options._html_main).append(__title_dom).append(this.options._html_closeBtn).append(__content_dom).append(__footer_dom);

			var __dialog_dom = $(this.options._html_framework).append(__main_dom).attr("id", this.options._dialog_id);

			this._render(__dialog_dom);
		},

		// 向页面中输出
		_render: function(_dialog_dom){

			// 向页面中写入样式
			$("head").append('<style id="kol-dialog-style-'+this.options._dialog_id+'">'+this.getDialogStyleCode()+this.options.customStyle+'</style>')	

			// 判断页面中是否已经存在其他弹出框,如果存在,需要设置当前弹出框的zindex值
			var _exist_dialog_length = $("body").find(".kol-dialog").size();

			// 向页面页面中写入弹出框主体
			$("body").prepend(_dialog_dom);

			this.options._dialog_obj = this;
			this.options._dialog_dom_obj = $("#"+this.options._dialog_id);

			// 设置样式及位置
			this._setDialogStyle(_exist_dialog_length);

			// 绑定事件
			this._bindEvent();
		},

		// 设置样式及位置
		_setDialogStyle: function(_exist_dialog_length){

			var _dialog_bg = this.options._dialog_dom_obj;
			var _dialog_self = this.options._dialog_dom_obj.find(".kol-dialog-main");

			// 设置背景的高和宽
			var winW = $.mytools.GetPageSize(window).WinW;
			var winH = $.mytools.GetPageSize(window).WinH;
			var pageH = $.mytools.GetPageSize(window).PageH;

			_dialog_bg.css({
				height: (pageH) + "px",
				width: (winW) + "px",
			}).removeClass(this.options.bg_outAnimation).addClass(this.options.bg_inAnimation).show();

			// 如果弹出框高度超出屏幕范围则启动弹出框内的滚动条
			if(_dialog_self.height() > winH){

				_dialog_self.css({
					height: ((winH - 40)/16) + "rem",
					width: ((_dialog_self.width() + 40)/16) + "rem",
					top: (((winH - (winH - 40))/2)/16) + "rem",
					left: (((winW - _dialog_self.width())/2)/16) + "rem",
				}).removeClass(this.options.outAnimation).addClass(this.options.inAnimation).show();

				_dialog_self.find(".kol-dialog-content").css({
					overflow: "auto",
					"margin-top": (25/16) + "rem",
					height: ((_dialog_self.height() - 10 - 25)/16) + "rem"
				});

			}else{
				_dialog_self.css({
					top: (((winH - _dialog_self.height())/2)/16) + "rem",
					left: (((winW - _dialog_self.width())/2)/16) + "rem",
				}).removeClass(this.options.outAnimation).addClass(this.options.inAnimation).show();

				if(this.options.contentOverflow === "auto"){
					_dialog_self.find(".kol-dialog-content").css({
						"overflow-y": "auto",
						height: ((_dialog_self.height() - 25)/16) + "rem"
					});
				}
			}

			// 设置弹出框的背景颜色
			_dialog_self.css("background", "#"+this.options.background);

			var zIndexVal = 999 + _exist_dialog_length;
			_dialog_bg.css("z-index", zIndexVal);
			_dialog_self.css("z-index", zIndexVal + 10);

			// 隐藏页面滚动条
			// $("html").css({overflow: "hidden"});
		},

		// 绑定事件
		_bindEvent: function(){

			var _self = this;
			var _dialog_self = this.options._dialog_dom_obj.find(".kol-dialog-main");

			// 关闭按钮
			_dialog_self.find(".closeBtn").find("a").click(function(){
				_self._closeDialog();
			});

			// 确定按钮
			_dialog_self.find("#confirmButton").click(function(){
				if(_self.options.confirmButtonFun){
					_self.options.confirmButtonFun();
				}
			});

			// 取消按钮
			_dialog_self.find("#cancelButton").click(function(){
				if(_self.options.cancelButtonFun){
					_self.options.cancelButtonFun();
				}

				// 取消按钮的默认事件 - 关闭弹出框
				_self._closeDialog();
			});

		},

		// 关闭弹出框
		_closeDialog: function(){

			var _self = this;
			var _dialog_id = this.options._dialog_id;
			var _dialog_bg = this.options._dialog_dom_obj;
			var _dialog_self = this.options._dialog_dom_obj.find(".kol-dialog-main");

			_dialog_self.removeClass(this.options.inAnimation).addClass(this.options.outAnimation);
			_dialog_bg.removeClass(this.options.bg_inAnimation).addClass(this.options.bg_outAnimation);
			// $("html").css({overflow: "auto"});

			setTimeout(function(){
				_dialog_self.remove();
				_dialog_bg.remove();
				$("body").find("#kol-dialog-style-"+_dialog_id).remove();

				_self.options.closeFun ? _self.options.closeFun() : "";

			}, this.options.animationSpeed);
		},

		// 取得弹出框样式代码
		getDialogStyleCode: function(){
			var __styel_code = [];
			__styel_code.push('.kol-dialog{display: none; position: absolute; width: 100%; background: rgba(20, 20, 20, 0.5); z-index: 9999;}');
			__styel_code.push('.kol-dialog.animated{animation-duration: '+(this.options.animationSpeed/1000)+'s;}');
			__styel_code.push('.kol-dialog .kol-dialog-main{display: none; position: fixed; padding: 0.625rem; min-height: 9.375rem; min-width: 21.875rem; border-radius: 0.25rem; z-index: 10000; -webkit-box-shadow: 0.125rem 0.125rem 0.25rem 0.0625rem rgba(51, 51, 51, 0.5) ; box-shadow: 0.125rem 0.125rem 0.25rem 0.0625rem rgba(51, 51, 51, 0.5) ;}');
			__styel_code.push('.kol-dialog .kol-dialog-main.animated{animation-duration: '+(this.options.animationSpeed/1000)+'s;}');
			__styel_code.push('.kol-dialog .kol-dialog-title{overflow: hidden; height: 1.875rem; clear: both;}');
			__styel_code.push('.kol-dialog .kol-dialog-title {float: left; color: #333; font-size: 0.875rem;}');
			__styel_code.push('.kol-dialog .kol-dialog-title i{color: #'+this.options.icon_color+'; margin-right: 0.3125rem;}');
			__styel_code.push('.kol-dialog .closeBtn{position: absolute; top: 0.625rem; right: 0.625rem; width: 1.25rem; height: 1.25rem; line-height: 1.25rem;}');
			__styel_code.push('.kol-dialog .closeBtn a{display: inline-block; text-align: center; text-decoration: none; color: #cecece; -webkit-transition: all .4s; -o-transition: all .4s; transition: all .4s;}');
			__styel_code.push('.kol-dialog .closeBtn a:hover{color: #cecece; -webkit-transform: rotateZ(180deg); transform: rotateZ(180deg);}');
			__styel_code.push('.kol-dialog .kol-dialog-content{clear: both; overflow: hidden; min-height: 3.75rem; font-size: 0.875rem;}');
			__styel_code.push('.kol-dialog .kol-dialog-footer{overflow: hidden; height: 2.5rem; line-height: 2.5rem; text-align: '+this.options.footerAlign+';}');
			__styel_code.push('.kol-dialog .kol-dialog-footer .btn{min-width: 4.375rem;}');

			return __styel_code.join(" ");
		}

	};

	var pluginDefaults = {
		"_dialog_obj": null,
		"_dialog_dom_obj": null,
		"_dialog_id": $.mytools.GetRandomNum(100000, 999999),
		"_html_framework": getDialogCode()._dialog_framework,
		"_html_main": getDialogCode()._dialog_main,
		"_html_title": getDialogCode()._dialog_title,
		"_html_closeBtn": getDialogCode()._dialog_closeBtn,
		"_html_content": getDialogCode()._dialog_content,
		"_html_footer": getDialogCode()._dialog_footer,
		"_html_icon": getDialogCode()._dialog_icon,

		"content": "",	// 弹出框内容
		"title": "",	// 弹出框标题
		"icon": "",	// 弹出框标题图标
		"icon_color": "666",	// 标题图标颜色
		"customStyle": "",	// 自定义样式
		"isShow_footer": false,	// 是否显示脚部
		"footerContent": "",	// 脚部自定义内容
		"footerAlign": "center",	// 脚部内容对其方式
		"isShowConfirmButton": true,	// 是否显示确定按钮
		"confirmButton": '好的,知道了',	// 确认按钮文字
		"isShowCancelButton": true,	// 是否显示取消按钮
        "cancelButton": '取消',	// 取消按钮文字
        "confirmButtonClass": 'btn-default',	// 确认按钮样式
        "cancelButtonClass": 'btn-default',	// 取消按钮样式
        "confirmButtonFun": function(){},	// 确认按钮执行方法
        "cancelButtonFun": function(){},	// 取消按钮执行方法
        "closeFun": function(){},	// 关闭弹出框后执行方法
        "contentOverflow": "hidden",	// 弹出框内容是否自动显示滚动条

        "animationSpeed": 600,	// 动画执行时间
        "background": "f0f0f0",	// 弹出框背景颜色
        "bg_inAnimation": "animated fadeIn",	// 背景进入动画
        "inAnimation": "animated slideInDown",	// 进入动画
        "bg_outAnimation": "animated fadeOut",	// 背景关闭动画
        "outAnimation": "animated slideOutDown"	// 关闭动画

	};

	// 取得弹出框代码
	function getDialogCode(){
		var __dialog_framework_code = null;	// 弹出框框架
		var __dialog_title_code = null;	// 弹出框标题
		var __dialog_closeBtn_code = null;	// 弹出框关闭按钮
		var __dialog_content_code = null;	// 弹出框内容
		var __dialog_footer_code = null;	// 弹出框脚部
		var __dialog_icon_code = null;	// 弹出框标题图标

		__dialog_framework_code = '<div class="kol-dialog"></div>';
		__dialog_main_code = '<div class="kol-dialog-main"></div>';
		__dialog_title_code = '<div class="kol-dialog-title"></div>';
		__dialog_closeBtn_code = '<div class="closeBtn"><a class="fa fa-times" href="javascript:void(0)" title="关闭"></a></div>';
		__dialog_content_code = '<div class="kol-dialog-content"></div>';
		__dialog_footer_code = '<div class="kol-dialog-footer"></div>';
		__dialog_icon_code = '<i class="fa "></i>';

		return {
			"_dialog_framework": __dialog_framework_code,
			"_dialog_main": __dialog_main_code,
			"_dialog_title": __dialog_title_code,
			"_dialog_closeBtn": __dialog_closeBtn_code,
			"_dialog_content": __dialog_content_code,
			"_dialog_footer": __dialog_footer_code,
			"_dialog_icon": __dialog_icon_code
		};
	}

	 $.kolDialog = function (options){
		var _kol_dialog = new kolDialog(options);
		return _kol_dialog._init();
	};

	$.kolDialog.close = function (thisDialog){
		if(thisDialog.options){
			thisDialog.options._dialog_obj._closeDialog();
			
			thisDialog.options.closeFun ? thisDialog.options.closeFun() : "";

		}else{
			thisDialog._dialog_obj._closeDialog();

			thisDialog.closeFun ? thisDialog.closeFun() : "";
		}
		
	};

	$.kolDialog.alert = function (content, confirmButtonFun){
		var _algin_content_code = [];
		_algin_content_code.push('<div class="kol-dialog-alert">');
		_algin_content_code.push('	<div class="row kol-dialog-alert-row">');
		_algin_content_code.push('		<div class="col-sm-10 col-sm-offset-1 kol-dialog-alert-content">'+ content +'</div>');
		_algin_content_code.push('	</div>');
		_algin_content_code.push('</div>');

		var _algin_style_code = [];
		_algin_style_code.push('.kol-dialog-alert{height: 3.75rem; text-align: center; font-size: 1rem;}');
		_algin_style_code.push('.kol-dialog-alert .kol-dialog-alert-row{height: 3.75rem;}');
		_algin_style_code.push('.kol-dialog-alert .kol-dialog-alert-row .icon{font-size: 1.5625rem; color: #3498db; text-align: center;}');
		_algin_style_code.push('.kol-dialog-alert .kol-dialog-alert-content{max-width: 21.875rem; text-align: center; padding-top: 0.9375rem;}');

		var dialog = $.kolDialog({
						"title": "提示",
						"icon": "fa fa-info-circle",
						"icon_color": "3498db",
						"content": _algin_content_code.join(""),
						"customStyle": _algin_style_code.join(""),
						"isShow_footer": true,
						"confirmButton": "好的",
						"confirmButtonClass": "btn-success",
						"isShowCancelButton": false,
						"confirmButtonFun": function(){
							$.kolDialog.close(this);
							if(confirmButtonFun){
								confirmButtonFun();
							}
						}
					});

		// 当alert弹出框,弹出后,将确定按钮设置为获得焦点
		dialog.dialog_dom_obj.find("#confirmButton").focus();

		return dialog;
	};

	var kolTipsDialogAutoCloseTimer = null;

	// 免打扰提示框
	$.kolDialog.tipsDialog = function(setting){

		var _self = this;

		// 参数
		this.tipsDialog_id = $.mytools.GetRandomNum(100000, 999999);	// ID
		this.tipsDialogObj = null;	// 提示框主体
		this.content = setting.content;	// 内容
		this.isAutoClose = setting.isAutoClose ? setting.isAutoClose : true;	// 是否自动关闭
		this.autoCloseTime = setting.autoCloseTime ? setting.autoCloseTime : 3;	// 自动关闭时长 单位: 秒
		this.backgroundColor = setting.backgroundColor ? setting.backgroundColor : "#2C3E50 ";	// 背景颜色, 默认深色
		this.iconBackgroundColor = setting.iconBackgroundColor ? setting.iconBackgroundColor : "#34495E ";	// 图标背景颜色, 默认深色
		this.position = setting.position ? setting.position : "top";	// 出现位置, 默认顶部出现
		this.inAnimation = setting.inAnimation ? setting.inAnimation : "animated slideInDown";	// 进入动画
		this.outAnimation = setting.outAnimation ? setting.outAnimation : "animated slideOutUp"	// 关闭动画
		this.animationSpeed = setting.animationSpeed ? setting.animationSpeed : 500;	// 动画执行时长 单位: 毫秒
		this.icon = setting.icon ? setting.icon : "fa fa-lightbulb-o";	// ICON图标
		this.closeBackFunction = setting.closeBackFunction ? setting.closeBackFunction : function(){};

		// 方法
		this.closeTipsDialog = null;

		var _tipsDialog_code = [];	// 主体代码
		var _tipsDialog_style = [];	// 主体样式

		_tipsDialog_code.push('<div id="'+this.tipsDialog_id+'" class="kol-tipsDialog">');
		_tipsDialog_code.push('	<div class="icon"><i class="'+this.icon+'"></i></div>');
		_tipsDialog_code.push('	<div class="content">'+this.content+'</div>');
		_tipsDialog_code.push('	<div class="closeBtn"><i class="fa fa-times"></i>X</div>');
		_tipsDialog_code.push('</div>');

		_tipsDialog_style.push('.kol-tipsDialog{display:none; position: fixed; top: 0.3125rem; left: 0.3125rem; max-width: 62.5rme; border: 0.0625rem #213141 solid; border-radius: 0.25rem 35px 35px 0.25rem; height: 2.1875rem; line-height: 2.125rem; overflow: hidden; clear: both; background: '+this.backgroundColor+'; -webkit-box-shadow: 0.125rem 0.125rem 0.25rem 0.0625rem rgba(51, 51, 51, 0.5) ; box-shadow: 0.125rem 0.125rem 0.25rem 0.0625rem rgba(51, 51, 51, 0.5); z-index: 99999999;}');
		_tipsDialog_style.push('.kol-tipsDialog.animated{animation-duration: '+this.animationSpeed/1000+'s;}');
		_tipsDialog_style.push('.kol-tipsDialog .icon{float: left; width: 1.875rem; background: '+this.iconBackgroundColor+'; border-right: 0.0625rem #213141 solid; text-align: center;}');
		_tipsDialog_style.push('.kol-tipsDialog .icon i{color: #F1C40F;}');
		_tipsDialog_style.push('.kol-tipsDialog .content{float: left; padding: 0 0.625rem; color: #BDC3C7; font-size: 0.875rem;}');
		_tipsDialog_style.push('.kol-tipsDialog .content a{color: #2ECC71; margin: 0 0.25rem;}');
		_tipsDialog_style.push('.kol-tipsDialog .content .markFont{color: #E67E22; margin: 0 0.25rem;}');
		_tipsDialog_style.push('.kol-tipsDialog .closeBtn{float: left; width: 1.875rem; text-align: center;}');
		_tipsDialog_style.push('.kol-tipsDialog .closeBtn i{color: #E74C3C; cursor: pointer; -webkit-transition: all .4s; -o-transition: all .4s ; transition: all .4s;}');
		_tipsDialog_style.push('.kol-tipsDialog .closeBtn i:hover{-webkit-transform: rotateZ(180deg); transform: rotateZ(180deg);}');

		// 写入到页面
		if($("head").find("[data-type=tipsDialog]").size() > 0){
			$("head").find("[data-type=tipsDialog]").remove();
			$(".kol-tipsDialog").remove();
			if(kolTipsDialogAutoCloseTimer){
				clearTimeout(kolTipsDialogAutoCloseTimer);
			}
		}

		$("head").append('<style data-type="tipsDialog" id="style_'+this.tipsDialog_id+'">'+_tipsDialog_style.join("")+'</style>');
		$("body").prepend(_tipsDialog_code.join(""));

		// 设置位置
		var _self_DOM = this.tipsDialogObj = $("#"+this.tipsDialog_id);

		var winW = $.mytools.GetPageSize(window).WinW;
		_self_DOM.css({left: ((winW - _self_DOM.width()) / 2) + "px"}).addClass(this.inAnimation).show();

		// 关闭按钮
		_self_DOM.find(".closeBtn").click(function() {
			_self.closeTipsDialog();
		});

		// 自动关闭
		if(this.isAutoClose){
			clearTimeout(kolTipsDialogAutoCloseTimer);
			kolTipsDialogAutoCloseTimer = setTimeout(function(){
				_self.closeTipsDialog();
			}, this.autoCloseTime * 1000);
		}

		// 关闭方法
		this.closeTipsDialog = function(isNow){
			_self_DOM.removeClass(this.inAnimation).addClass(this.outAnimation);
			var timer = setTimeout(function(){
				_self_DOM.remove();
				clearTimeout(timer);
				clearTimeout(this.autoCloseTimer);

				// 执行关闭回调方法
				_self.closeBackFunction();

			}, this.animationSpeed);
		}

		return _self;
	};

})(jQuery)
