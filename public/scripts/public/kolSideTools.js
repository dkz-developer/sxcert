/**
 * 侧边工具栏
 * @authors SX
 * @date    2015-10-09 22:19:02
 */

 function SideTools(){}
 var kolSideTools = new SideTools();

;(function($){
	SideTools.prototype.init = function(setting) {
		this._sideTools_obj = $('<div class="kol-sideTools"></div>');

		if(setting && setting.needGoTop){
			var _goTop = new goTop();
			this._sideTools_obj.prepend(_goTop.getCode());
		}


		if(setting && !setting.noneedSales) {
			var _sales = new sales();
			this._sideTools_obj.prepend(_sales.getCode());
		}


		this.show();

		if(setting && setting.needGoTop){
			var _goTop = new goTop();
			_goTop.bindEvent();
		}

		if(setting && !setting.noneedSales) {
			var _sales = new sales();
			_sales.bindEvent();
		}




		var _topVal = $.mytools.GetPageSize(window).WinH - this._sideTools_obj.height() - 10;
		$(window).scroll(function() {
			var _scroll_val = $.mytools.GetPageScroll(window).Y;

			$(".kol-sideTools").css({
				top: (_scroll_val+_topVal) + "px"
			});

			if(_scroll_val <= 0){
				$(".kol-sideTools").find(".goTop").hide();
			}else{
				$(".kol-sideTools").find(".goTop").show();
			}
		});
	};

	SideTools.prototype.show = function() {

		var styleCode = [];
		styleCode.push('.kol-sideTools{position: absolute; width: 2.5rem; top: 0; left: 0; z-index: 999;}');
		styleCode.push('.kol-sideTools div{margin-top: 0.625rem;}');
		styleCode.push('.kol-sideTools .goTop{width: 2.5rem; height: 2.5rem; border-radius: 0.25rem; background: #1aa1e5; cursor: pointer;}');
		styleCode.push('.kol-sideTools .goTop i{color: #fff; margin: 0.5rem 0 0 0.375rem; font-size: 1.875rem; -webkit-transform: rotateZ(-45deg); transform: rotateZ(-45deg);}');
		styleCode.push('.kol-sideTools .sales{position: relative; width: 2.5rem; height: 2.5rem; border-radius: 0.25rem; background: #1aa1e5;}');
		styleCode.push('.kol-sideTools .sales i{color: #fff; margin: 5px 0 0 10px; font-size: 1.875rem; cursor: pointer;}');
		styleCode.push('.kol-sideTools .sales .details{display: none; position: absolute; left: -161px; width: 160px; background: #fff; font-size: 12px; border-top: 3px solid #1aa1e5; padding-top: 6px; padding-bottom: 10px; box-shadow: 0px 0px 3px rgba(0,0,0,.2);}');
		styleCode.push('.kol-sideTools .sales .details li{line-height: 32px;}');
		styleCode.push('.kol-sideTools .sales .details li i{color: #1aa1e5; font-size: 17px; margin:0 13px 0 20px}');
		styleCode.push('.kol-sideTools .sales .details li a{color: #333; margin-left: -3px;}');
		styleCode.push('.kol-sideTools .sales .details li img{width: 80px; height: 80px;}');
		styleCode.push('.kol-sideTools .sales .details li.align-center{text-align:center;}');
		$("head").append("<style>"+styleCode.join("")+"</style>");

		$("body").append(this._sideTools_obj);

		// 设置侧边栏的位置
		var _sideTools = $(".kol-sideTools");
		var leftVal = $(".mainContent > .inner").offset().left + $(".mainContent > .inner").width() + 10;
		var topVal = $.mytools.GetPageSize(window).WinH - _sideTools.height() - 10;
		_sideTools.css({
			left: leftVal + "px",
			top: topVal + "px"
		});
	};

	// 回到顶端工具代码
	var goTop = function(){
		var code = '<div class="goTop"><i class="fa fa-rocket"></i></div>';

		return {
			"getCode": function(){
				return code;
			},

			"bindEvent": function(){
				$(".goTop").click(function(){
					$("html body").animate({scrollTop: 0}, 400);
					$("html").animate({scrollTop: 0}, 400);
				});
			}
		};
	};

	// 值班销售
	var sales = function(){

		var USERTYPE =  $.mytools.getCookie("Type");	// 当前登录用户的类型 0: KOL 1: 企业主

		var code = [];
		code.push('<div class="sales">');
		code.push('	<i class="fa fa-phone"></i>');
		code.push('	<div class="details"></div>');
		code.push('</div>');

		return {
			"getCode": function(){
				return code.join("");
			},

			"bindEvent": function(){
				$(".sales").click(function(){
					$(".sales").find(".details").empty().hide();
					if(USERTYPE == "1"){
						$.post("/interface/company/getdutymanager.php", {}, function(backData) {

							if(backData && backData.code === "S"){
								var detailsCode = [];
								detailsCode.push('<ul>');
								detailsCode.push('	<li class="align-center">销售联系方式</li>');
								detailsCode.push('	<li><i class="fa fa-user"></i>'+backData.msg.realname+'</li>');
								detailsCode.push('	<li><i class="fa fa-qq"></i><a href="tencent://message/?uin='+backData.msg.qq+'&Site=&Menu=yes">'+backData.msg.qq+'</a></li>');
								detailsCode.push('	<li><i class="fa fa-phone"></i>'+backData.msg.enterpriseTelephone+'</li>');
								if(backData.msg.QRImageRrl) {
									detailsCode.push('	<li class="align-center"><img src="'+backData.msg.QRImageRrl+'" alt="" /></li>');
								}else {
									detailsCode.push('	<li class="align-center" style="height: 80px;"></li>');
								}
								detailsCode.push('</ul>');
								$(".sales").find(".details").append(detailsCode.join("")).show();
								$(".sales").find(".details").css("top","-197px");
							}
						}, "json");	
					}else if(USERTYPE == "0"){
						var detailsCode = [];
						detailsCode.push('<ul>');
						detailsCode.push('	<li class="align-center">媒介联系方式</li>');
						detailsCode.push('	<li><i class="fa fa-qq"></i><a href="tencent://message/?uin=800009441&Site=&Menu=yes">800009441</a></li>');
						detailsCode.push('	<li><i class="fa fa-phone"></i>400-000-6230</li>');
						// detailsCode.push('	<li class="align-center"><img src="'+backData.msg.QRImageRrl+'" alt="" /></li>');
						detailsCode.push('</ul>');
						$(".sales").find(".details").append(detailsCode.join("")).show();
						$(".sales").find(".details").css("top","-84px");
					}
					
				});

				$(window.document).click(function(event){
					var e = event || window.event;
					var _target = e.target || e.srcElement;
					if(!$(_target).hasClass("sales") && !$(_target).hasClass("fa-phone")){
						$(".sales").find(".details").empty().hide();
					}
				});
			}
		};
	};

})(jQuery)