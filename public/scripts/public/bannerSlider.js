/**
 * bannerSlider - banner轮播图片插件
 * @authors SX
 * @date    2015-09-14 16:39:40
 */
// 使用方法 - HTML格式:
// <div class="bannerSlider">
// 	<ul>
// 		<li>This is a slide.</li>
// 		<li>This is another slide.</li>
// 		<li>This is a final slide.</li>
// 		<li>This is a final slide.</li>
// 	</ul>
// </div>
 if (typeof jQuery === 'undefined') {
    throw new Error('phone-preview requires jQuery');
}
;(function($){

	var pluginName = "bannerSlider";

	// bannerContent: banner容器
	var bannerSlider = function(bannerContent){

		this._content = bannerContent;
		this._items = null;
		this._item_width = 0;	// 每个banner的宽度
		this._sum_width = 0;	// 所有banner的总宽度
		this._intervalTime = 5;	// 间隔时间(单位: 秒)
		this._currentActiveIndex = 0;	// 当前显示的banner下标
		this._offsetList = [];	// 每个banner初始化时的偏移位置

		this._chooseOptionDom = null;	// 选择banner按钮

		this._interval = null;	// 动画settimeout

		this._className = bannerContent.attr("class") ? bannerContent.attr("class").split(" ")[0] : "bannerSlider";
		this._cssCode = "."+this._className+" {position: relative; overflow: hidden;} "+
						"."+this._className+" ul li{float: left; height: 25.625rem;} "+
						"."+this._className+"-chooseOption{position: absolute; z-index: 99; opacity: 0;} "+
						"."+this._className+"-chooseOption a{display: inline-block; margin-right:5px; width: .9375rem; height: .9375rem; border-radius: .9375rem; background: #fff; opacity: .5;} "+
						"."+this._className+"-chooseOption a:hover{background: #000;} "+
						"."+this._className+"-chooseOption a.active{background: #000;}";

		this._init();
	};

	bannerSlider.prototype = {

		// 初始化方法
		_init: function(){
			var self = this;

			// 向页面中写入样式
			$("body").prepend("<style>"+self._cssCode+"</style>");

			self._items = self._content.find("li");
			// 根据屏幕宽度设置banner容器宽度
			var winW = GetPageSize(window).WinW;
			self._item_width = winW;
			self._sum_width = self._items.size() * self._item_width;
			self._content.find("ul").width(self._sum_width);
			self._items.each(function(){
				$(this).width(self._item_width);
				self._offsetList.push($(this).offset().left);
			});

			self._chooseOption();
			self._start();
		},

		// 开始轮播
		_start: function(){
			var self = this;
			self._interval = setTimeout(function(){
				// alert(self._currentActiveIndex+"   "+self._items.size());
				if(($(self._content).scrollLeft() + self._item_width) <= (self._sum_width - self._item_width)){
					$(self._content).animate({scrollLeft:($(self._content).scrollLeft() + self._item_width)+"px"},"slow");
					self._currentActiveIndex++;
				}else{
					$(self._content).animate({scrollLeft:"0"},400);
					self._currentActiveIndex = 0;					
				}
				self._setChooseOption();
				clearTimeout(self._interval);
				self._start();
			}, self._intervalTime * 1000);
		},

		// 选择banner按钮
		_chooseOption: function(){
			var self = this;
			var _chooseOptionCode = [];
			_chooseOptionCode.push('<div class="'+self._className+'-chooseOption">');
			for (var i = 0; i < self._items.size(); i++) {
				if(i === 0){
					_chooseOptionCode.push(' <a class="active" href="javascript:void(0)"></a>');	
				}else{
					_chooseOptionCode.push(' <a href="javascript:void(0)"></a>');
				}
			};
			_chooseOptionCode.push('</div>');

			$(self._content).before(_chooseOptionCode.join(""));

			self._chooseOptionDom = $("."+self._className+"-chooseOption");

			// 调整位置
			self._chooseOptionDom.css({"top":"31.875rem", "left":((this._item_width-self._chooseOptionDom.width())/2)+"px", "opacity":"1"});

			// 点击事件
			self._chooseOptionDom.find("a").click(function(){
				clearTimeout(self._interval);
				var _index = $(this).index();
				self._currentActiveIndex = _index;
				$(self._content).animate({scrollLeft:self._offsetList[_index]},200);
				self._setChooseOption();
				self._start();
			});
		},

		// 设置当前"选择bannner按钮"的样式
		_setChooseOption: function(){
			var self = this;
			self._chooseOptionDom.find("a").removeClass("active");
			self._chooseOptionDom.find("a").eq(self._currentActiveIndex).addClass("active");
		}

	};

	$.fn[pluginName] = function(){
		return new bannerSlider(this);
	};

	// 获取页面大小
	function GetPageSize(win) {
		var scrW, scrH;
		if(win.innerHeight && win.scrollMaxY) {
			// Mozilla
			scrW = win.innerWidth + win.scrollMaxX;
			scrH = win.innerHeight + win.scrollMaxY;
		} else if(win.document.body.scrollHeight > win.document.body.offsetHeight){
			// all but IE Mac
			scrW = win.document.body.scrollWidth;
			scrH = win.document.body.scrollHeight;
		} else if(win.document.body) { // IE Mac
			scrW = win.document.body.offsetWidth;
			scrH = win.document.body.offsetHeight;
		}

		var winW, winH;
		if(win.innerHeight) { // all except IE
			winW = win.innerWidth;
			winH = win.innerHeight;
		} else if (win.document.documentElement  && win.document.documentElement.clientHeight) {
			// IE 6 Strict Mode
			winW = win.document.documentElement.clientWidth;
			winH = win.document.documentElement.clientHeight;
		} else if (win.document.body) { // other
			winW = win.document.body.clientWidth;
			winH = win.document.body.clientHeight;
		}

		// for small pages with total size less then the viewport
		var pageW = (scrW<winW) ? winW : scrW;
		var pageH = (scrH<winH) ? winH : scrH;

		return {PageW:pageW, PageH:pageH, WinW:winW, WinH:winH};
	}

})(jQuery)
