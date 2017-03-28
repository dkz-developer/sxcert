/**
 * @authors SX
 * @date    2014-08-07 13:31:41
 * @explain 前端工具集合 PS；维护人员；注意保证每个方法的独立性与通用性
 */

// ------------------------自定义的工具类------------------------

;(function($){

	function ToolsClass	(){
		var js_path = document.getElementById("tools_js") ? document.getElementById("tools_js").src : "";
		var css_path =  document.getElementById("common_css") ? document.getElementById("common_css").href : "";
		this.imgUrl = css_path ? css_path.substring(0, css_path.indexOf("scripts/")) : "";
		this.jsUrl = js_path ? js_path.substring(0, js_path.indexOf("scripts/")) : "";

		// 上传接口 by kyz
		var location_host = location.host;  // 根据域名判断对应的bridge接口url
		//处理kol
		if(location_host === "pwww.kolstore.com"  || location_host === "padmin.kolstore.com") {
			this.uploadUrl = "https://pbridge.kolstore.com";
		}else if(location_host === "mwww.kolstore.com"  || location_host === "madmin.kolstore.com") {
			this.uploadUrl = "https://mbridge.kolstore.com";
		}else if(location_host === "www.kolstore.com"  || location_host === "manage.kolstore.com") {
			this.uploadUrl = "https://bridge.kolstore.com";
		}
		//处理oem
		else if(location_host === "admin.oemv26.kolstore.com"  || location_host === "oemv26.kolstore.com") {
			this.uploadUrl = "http://bridge.oemv26.kolstore.com";
		}else if(location_host === "admin.oem-v2.4.kolstore.com"  || location_host === "oem-v2.4.kolstore.com") {
			this.uploadUrl = "http://bridge.oem-v2.4.kolstore.com";
		}

		// 处理rank调kol接口
		else if(location_host === "prank.kolstore.com") {
			this.rankRequestUrl = "//pwww.kolstore.com";
		}else if(location_host === "mrank.kolstore.com") {
			this.rankRequestUrl = "//mwww.kolstore.com";
		}else if(location_host === "rank.kolstore.com") {
			this.rankRequestUrl = "//www.kolstore.com";
		}

	}

	ToolsClass.prototype = {

		// 按需加载JS文件
		requireScript: function(scriptId, scriptName, initFun){
			var head = document.getElementsByTagName('head')[0];
			var oldScript = document.getElementById(scriptId);

			if(oldScript){
				head.removeChild(oldScript);
			}
			var newScript = document.createElement('script');
			newScript.charset = 'utf-8';
			newScript.id = scriptId;
			newScript.type = 'text/javascript';
			newScript.src = this.jsUrl+"scripts"+scriptName;

			var scriptLoaded = 0;
			// IE和opera支持onreadystatechange
	        // safari、chrome、opera支持onload
	        newScript.onload = newScript.onreadystatechange = function () {
	            // 避免opera下的多次调用
	            if (scriptLoaded) {
	                return;
	            };

	            var readyState = newScript.readyState;
	            if ('undefined' == typeof readyState
	                || readyState == "loaded"
	                || readyState == "complete") {
	                scriptLoaded = 1;
	                try {
	                	if(initFun){
	                		initFun();
	                	}
	                } finally {
	                    newScript.onload = newScript.onreadystatechange = null;
	                }
	            }
	        };

			head.appendChild(newScript);
		},

		// 获取页面滚动条数据
		GetPageScroll: function(win) {
			var x, y;
			if(win.pageYOffset) {
				// all except IE
				y = win.pageYOffset;
				x = win.pageXOffset;
			} else if(win.document.documentElement  && win.document.documentElement.scrollTop) {
				// IE 6 Strict
				y = win.document.documentElement.scrollTop;
				x = win.document.documentElement.scrollLeft;
			} else if(document.body) {
				// all other IE
				y = win.document.body.scrollTop;
				x = win.document.body.scrollLeft;
			}
			return {X:x, Y:y};
		},

		// 获取页面大小
		GetPageSize: function(win) {
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
		},

		// 取得数组中最大值
		_array_getMaxVal: function(array){
			return Math.max.apply({},array);
		},

		// 取得数组中最小值
		_array_getMinVal: function(array){
			return Math.min.apply({},array);
		},

		// 向数组中加入项(有查重功能)
		_array_addItem: function(array, item){
			if(array.length <= 0){array.push(item); return false;}
			for(var i=0,len=array.length; i<len; i++){
				if(array[i] === item){
					return false;
				}else{
					array.push(item);
					break;
				}
			}
		},

		// 删除数组中指定的项
		_array_removeItem: function(array, item){
			for(var i=0,len=array.length; i<len; i++){
				if(array[i] === item){
					array.splice(i, 1);
				}
			}
		},

		// 删除字符串中的前后空格
		_string_trim: function(str){
			return str.replace(/(^\s*)|(\s*$)/g, "");
		},

		// 删除字符串中的所有空格
		_string_trimAll: function(str){
			return str.replace(/\s/g,"");
		},

		// 删除字符串中的左侧空格
		_string_ltrim: function(str){
			return str.replace(/(^\s*)/g, "");
		},

		// 删除字符串中的右侧空格
		_string_rtrim: function(str){
			return str.replace(/(\s*$)/g, "");
		},

		// ------------------------字符串验证通用方法------------------------
		/*
		** 用途：检查输入字符串是否为空或者全部都是空格
		** 输入：str
		** 返回：如果全是空返回true,否则返回false
		*/
		isNull: function(str){
		    if(str == ""){
		      return true;
		    }else if(str == "null" || str === null){
		      return true;
		    }
		    var regu = "^[ ]+$";
		    var re = new RegExp(regu);
		    return re.test(str);
		},

		/*
		** 用途：检查输入的Email信箱格式是否正确
		** 输入：strEmail：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		checkEmail: function(strEmail){
			var emailReg = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
		    if(emailReg.test(strEmail)){
		        return true;
		    }else{
		        return false;
		    }
		},


		/*
		 ** 用途：检查输入的qqEmail信箱格式是否正确
		 ** 输入：strqqEmail：字符串
		 ** 返回：如果通过验证返回true,否则返回false
		 */
		checkqqEmail: function(strEmail){
			var regu = /^[a-zA-Z][A-Za-z0-9\.|-|_]+[A-Za-z0-9]+@[qQ][qQ]\.com$/;
			if(regu.test(strEmail)){
				return true;
			}else{
				return false;
			}
		},


		/*
		** 用途：检查输入手机号码是否正确
		** 输入：strMobile：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		checkMobile: function(strMobile){
		    var regu = /^[1][1-9][0-9]{9}$/;
		    var re = new RegExp(regu);
		    if (re.test(strMobile)) {
		        return true;
		    }else{
		        return false;
		    }
		},

		/*
		** 用途：检查输入字符串是否只由英文字母和数字和下划线组成
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		isNumberOr_Letter: function(str){
		    var regu = "^[0-9a-zA-Z\_]+$";
		    var re = new RegExp(regu);
		    if(re.test(str)){
		        return true;
		    }else{
		        return false;
		    }
		},

		/*
		** 用途：检查输入字符串是否纯数字
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		isNumber: function(str){
		    var regu = "^[0-9]+$";
		    var re = new RegExp(regu);
		    if(re.test(str)){
		        return true;
		    }else{
		        return false;
		    }
		},

		/*
		** 用途：检查输入字符串是否是负数
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		isNegativeNumber: function(str){
		    var regu = "^[-0-9]+$";
		    var re = new RegExp(regu);
		    if(re.test(str)){
		        return true;
		    }else{
		        return false;
		    }
		},

		/*
		** 用途：检查输入字符串是否flaot型数字
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		isFloat: function(str){
		    var regu = "^[0-9\.]+$";
		    var re = new RegExp(regu);
		    if(re.test(str)){
		        return true;
		    }else{
		        return false;
		    }
		},

		/*
		** 用途：检查输入字符串是否数字和字母组成
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		isNumberOrLetter: function(str){
		    var regu = "^[0-9a-zA-Z]+$";
		    var re = new RegExp(regu);
		    if(re.test(str)){
		        return true;
		    }else{
		        return false;
		    }
		},

		/*
		** 用途：检查输入字符串是否含有中文
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		isHasChinese: function(str){
			var regu = "[\u4e00-\u9fa5]";
		    var re = new RegExp(regu);
		    if(re.test(str)){
		        return true;
		    }else{
		        return false;
		    }
		},

		/*
		** 用途：检查输入字符串是否只有中文
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		isOnlyChinese: function(str){
			var regu = "^[\u4e00-\u9fa5]+$";
			var re = new RegExp(regu);
			if(re.test(str)){
				return true;
			}else{
				return false;
			}
		},

		/*
		** 用途：检查输入字符串是否为有效的身份证号
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		isCardNo: function(card){
		   // 身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X
		   var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
		   if(reg.test(card)){
		       return true;
		   }else{
		      return false;
		   }
		},

		/*
		** 用途：检查输入字符串是否以字母开头
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		isLetterStart: function(str){
		    var regu = "^[a-zA-Z]";
		    var re = new RegExp(regu);
		    if(re.test(str)){
		        return true;
		    }else{
		        return false;
		    }
		},

		/*
		** 用途：检查输入的字符串的长度是否符合标准
		** 输入：str：字符串 minNum:最小长度 maxNum:最大长度
		** 返回：如果通过验证返回true,否则返回false
		*/
		checkLength: function (str, minNum, maxNum){
			if(str.length >= minNum && str.length <= maxNum){
				return true;
			}else{
				return false;
			}
		},

		/*
		** 用途：剔除字符串中的敏感字符,防止script代码注入
		** 输入：str：字符串
		** 返回：如果通过验证返回true,否则返回false
		*/
		stripScript: function(str){
			var pattern = new RegExp("[&*<>;]");
			var rs = "";
			for (var i = 0; i < str.length; i++) {
			 rs = rs+str.substr(i, 1).replace(pattern, '');
			}
			return rs;
		},

		/*
		** 用途：查看字符串的字节数
		** 输入：str：字符串
		** 返回：字节数
		*/
		getBytesLength: function(str) {
			// 在GBK编码里，除了ASCII字符，其它都占两个字符宽
			return str.replace(/[^\x00-\xff]/g, 'xx').length;
		},

		// ------------------------cookie操作------------------------
		/*
		** 用途：向浏览器添加cookie
		** 输入：objName : 存入的cookie名称  |  objValue : 对应的cookie值  |  objHours : cookie保存时间
		** 返回：无返回值
		*/
		addCookie: function(objName,objValue,objHours){
			var str = objName + "=" + escape(objValue);
			if(objHours > 0){//为0时不设定过期时间，浏览器关闭时cookie自动消失
				var date = new Date();
				var ms = objHours*3600*1000;
				date.setTime(date.getTime() + ms);
				str += "; expires=" + date.toGMTString();
			}
			document.cookie = str;
		},

		/*
		** 用途：根据cookie名称取得cookie值
		** 输入：objName : cookie名称
		** 返回：与cookie名称对应的cookie值(如果存在的话)
		*/
		getCookie: function(objName){
			var arrStr = document.cookie.split("; ");
			for(var i = 0;i < arrStr.length;i ++){
				var temp = arrStr[i].split("=");
				if(temp[0] == objName){
					return unescape(temp[1]);
				}
			}
			return null;
		},

		/*
		** 用途：根据cookie名称删除cookie
		** 输入：objName : cookie名称
		** 返回：无返回值
		*/
		delCookie: function(objName){
			var date = new Date();
			date.setTime(date.getTime() - 10000);
			document.cookie = objName + "=a; expires=" + date.toGMTString();
		},

		/*
		** 用途：取得浏览器中的所有cookie
		** 输入：无
		** 返回：所有cookie的字符串
		*/
		allCookie: function(){
			return document.cookie;
		},

		/*
		** 用途：传入范围,在范围内生成随机数
		** 输入：Min：最小数	Max：最大数
		** 返回：随机数
		*/
		GetRandomNum: function(Min,Max){
		  var Range = Max - Min;
		  var Rand = Math.random();
		  return(Min + Math.round(Rand * Range));
		},

		/*
		** 用途：取得地址中的参数
		** 输入：name: key值
		** 返回：key值对应的值
		*/
		GetQueryString: function(name){
			var result = "";
			var searchStr = window.location.search.substr(1);
			if(!searchStr || searchStr === ""){return null;}

			searchs = searchStr.split("&");
			var querys = {};
			for (var i = searchs.length - 1; i >= 0; i--) {
				querys[searchs[i].split("=")[0]] = searchs[i].split("=")[1];
			};

			if(querys[name] && querys[name] !== "" && querys[name] !== "null"){
				result = querys[name];
			}

			return result;
		},

		// 输入框效果
		loadInputComponentEvent: function(){
			var inputs = $(".input-component").find("input");
			inputs.each(function(){
				$(this).focus(function(){
					$(this).parent().addClass("input-component-onfocus");
					$(this).siblings("label").addClass("active active-font");
					if($(this).parent().hasClass("input-error")){
						$(this).siblings("label").addClass("error-font-color");
					}else{
						$(this).siblings("label").removeClass("error-font-color");
					}
				});
				$(this).focusout(function(){
					$(this).parent().removeClass("input-component-onfocus");
					if(!$(this).val()){
						$(this).siblings("label").removeClass("active active-font");
						if($(this).parent().hasClass("input-error")){
							$(this).siblings("label").addClass("error-font-color");
						}else{
							$(this).siblings("label").removeClass("error-font-color");
						}
					}else{
						$(this).siblings("label").removeClass("active-font");
						if($(this).parent().hasClass("input-error")){
							$(this).siblings("label").addClass("error-font-color");
						}else{
							$(this).siblings("label").removeClass("error-font-color");
						}
					}
				});
			});
		},

		// 数组去重复
		array_unique: function(array){
			var n = {}, r = []; //n为hash表，r为临时数组
			for(var i = 0; i < array.length; i++){ //遍历当前数组
				if (!n[array[i]]){ //如果hash表中没有当前项
					n[array[i]] = true; //存入hash表
					r.push(array[i]); //把当前数组的当前项push到临时数组里面
				}
			}
			return r;
		},

		// 取得鼠标进入对象的方位
		// mouseEvent: 鼠标对象  enterObj: 进入对象
		getMousePosition: function(mouseEvent, enterObj){
			enterObj = $(enterObj);
			var w = $(enterObj).width();
			var h = $(enterObj).height();
			var x = (mouseEvent.pageX - enterObj.offset().left - (w / 2)) * (w > h ? (h / w) : 1);
			var y = (mouseEvent.pageY - enterObj.offset().top - (h / 2)) * (h > w ? (w / h) : 1);
			var direction = Math.round((((Math.atan2(y, x) * (180 / Math.PI)) + 180) / 90) + 3) % 4;
			var eventType = mouseEvent.type;
			var dirName = new Array('top','right','bottom','left');
			if(eventType == 'mouseenter'){
				return dirName[direction];
			}else{
				return dirName[direction];
			}
			return null;
		},

		// 根据条件显示对应字数的字符串, 如果多则剪切
		getStringByNum: function(str, num){
			if(str){
				if(str.length > num){
					str = str.substr(0, num) + "...";
				}
				return str;
			}
			return str;
		},

		//---------------------------------------------------
		// 日期格式化
		// 格式 YYYY/yyyy/YY/yy 表示年份
		// MM/M 月份
		// W/w 星期
		// dd/DD/d/D 日期
		// hh/HH/h/H 时间
		// mm/m 分钟
		// ss/SS/s/S 秒
		//---------------------------------------------------
		dateFormat: function(date, formatStr){
		    var str = formatStr;
		    var Week = ['日','一','二','三','四','五','六'];

		    str=str.replace(/yyyy|YYYY/,date.getFullYear());
		    str=str.replace(/yy|YY/,(date.getYear() % 100)>9?(date.getYear() % 100).toString():'0' + (date.getYear() % 100));

		    str=str.replace(/MM/,date.getMonth()+1>9?(date.getMonth()+1).toString():'0' + (date.getMonth()+1));
		    str=str.replace(/M/g,date.getMonth()+1);

		    str=str.replace(/w|W/g,Week[date.getDay()]);

		    str=str.replace(/dd|DD/,date.getDate()>9?date.getDate().toString():'0' + date.getDate());
		    str=str.replace(/d|D/g,date.getDate());

		    str=str.replace(/hh|HH/,date.getHours()>9?date.getHours().toString():'0' + date.getHours());
		    str=str.replace(/h|H/g,date.getHours());
		    str=str.replace(/mm/,date.getMinutes()>9?date.getMinutes().toString():'0' + date.getMinutes());
		    str=str.replace(/m/g,date.getMinutes());

		    str=str.replace(/ss|SS/,date.getSeconds()>9?date.getSeconds().toString():'0' + date.getSeconds());
		    str=str.replace(/s|S/g,date.getSeconds());

		    return str;
		},

		//+---------------------------------------------------
		//| 关于日期操作的一些操作 - 取得当前日期
		//| 格式为 2015-11-03 15:34
		//+---------------------------------------------------
		getCurentTime: function(){

			var now = new Date();
			var year = now.getFullYear();       //年
			var month = now.getMonth() + 1;     //月
			var day = now.getDate();            //日

			var hh = now.getHours();            //时
			var mm = now.getMinutes();          //分
			var ss = ":00";          //秒

			var clock = year + "-";

			if(month < 10){
				clock += "0";
			}

			clock += month + "-";

			if(day < 10){
				clock += "0";
			}

			clock += day + " ";

			if(hh < 10){
				clock += "0";
			}

			clock += hh + ":";

			if (mm < 10){
				clock += '0';
			}

			clock += mm + ss;
			return(clock);
		},

		//+---------------------------------------------------
		//| 日期计算 - 增加
		//+---------------------------------------------------
		dateAdd: function(date, strInterval, Number) {
		    var dtTmp = date;
		    switch (strInterval) {
		        case 's' :return new Date(Date.parse(dtTmp) + (1000 * Number));  // 秒
		        case 'n' :return new Date(Date.parse(dtTmp) + (60000 * Number));  // 分
		        case 'h' :return new Date(Date.parse(dtTmp) + (3600000 * Number));  // 时
		        case 'd' :return new Date(Date.parse(dtTmp) + (86400000 * Number));  	// 天
		        case 'w' :return new Date(Date.parse(dtTmp) + ((86400000 * 7) * Number));  // 周
		        case 'q' :return new Date(dtTmp.getFullYear(), (dtTmp.getMonth()) + Number*3, dtTmp.getDate(), dtTmp.getHours(), dtTmp.getMinutes(), dtTmp.getSeconds());  // 季
		        case 'm' :return new Date(dtTmp.getFullYear(), (dtTmp.getMonth()) + Number, dtTmp.getDate(), dtTmp.getHours(), dtTmp.getMinutes(), dtTmp.getSeconds());  // 月
		        case 'y' :return new Date((dtTmp.getFullYear() + Number), dtTmp.getMonth(), dtTmp.getDate(), dtTmp.getHours(), dtTmp.getMinutes(), dtTmp.getSeconds());  // 年
		    }
		},

		//+---------------------------------------------------
		//| 日期计算 - 减去
		//+---------------------------------------------------
		dateMinus: function(date, strInterval, Number) {
		    var dtTmp = date;
		    switch (strInterval) {
		        case 's' :return new Date(Date.parse(dtTmp) - (1000 * Number));  // 秒
		        case 'n' :return new Date(Date.parse(dtTmp) - (60000 * Number));  // 分
		        case 'h' :return new Date(Date.parse(dtTmp) - (3600000 * Number));  // 时
		        case 'd' :return new Date(Date.parse(dtTmp) - (86400000 * Number));  	// 天
		        case 'w' :return new Date(Date.parse(dtTmp) - ((86400000 * 7) * Number));  // 周
		        case 'q' :return new Date(dtTmp.getFullYear(), (dtTmp.getMonth()) - Number*3, dtTmp.getDate(), dtTmp.getHours(), dtTmp.getMinutes(), dtTmp.getSeconds());  // 季
		        case 'm' :return new Date(dtTmp.getFullYear(), (dtTmp.getMonth()) - Number, dtTmp.getDate(), dtTmp.getHours(), dtTmp.getMinutes(), dtTmp.getSeconds());  // 月
		        case 'y' :return new Date((dtTmp.getFullYear() - Number), dtTmp.getMonth(), dtTmp.getDate(), dtTmp.getHours(), dtTmp.getMinutes(), dtTmp.getSeconds());  // 年
		    }
		},

		//+---------------------------------------------------
		//| 比较日期差 dtEnd 格式为日期型或者有效日期格式字符串
		//+---------------------------------------------------
		dateDiff: function(date, strInterval, dtEnd) {
		    var dtStart = date;
		    switch (strInterval) {
		        case 's' :return parseInt((dtEnd - dtStart) / 1000);  // 秒
		        case 'n' :return parseInt((dtEnd - dtStart) / 60000);  // 分
		        case 'h' :return parseInt((dtEnd - dtStart) / 3600000);  // 时
		        case 'd' :return parseInt((dtEnd - dtStart) / 86400000);  // 天
		        case 'w' :return parseInt((dtEnd - dtStart) / (86400000 * 7));  // 周
		        case 'm' :return (dtEnd.getMonth()+1)+((dtEnd.getFullYear()-dtStart.getFullYear())*12) - (dtStart.getMonth()+1);  // 月
		        case 'y' :return dtEnd.getFullYear() - dtStart.getFullYear();  // 年
		    }
		},

		getMonthDays: function(selectedDate){
			var year = selectedDate.substring(0,4);
			var month= selectedDate.substring(5,7);
			var d = new Date(year, month, 0);
			var daysCount = d.getDate();
			return daysCount;
		},

		DatetoArray: function(date){
			var myDate = date;
			var myArray = Array();
			myArray[0] = myDate.getFullYear();
			myArray[1] = myDate.getMonth();
			myArray[2] = myDate.getDate();
			myArray[3] = myDate.getHours();
			myArray[4] = myDate.getMinutes();
			myArray[5] = myDate.getSeconds();
			return myArray;
		},

		//+---------------------------------------------------
		//| 字符串转日期类型
		//+---------------------------------------------------
		StringToDate: function(DateStr){
			if(!DateStr){return false;}
			var _date = DateStr.split(" ")[0];
			var _time = DateStr.split(" ")[1];
			var arys= _date.split('-');
			var arys_time= _time.split(':');
			myDate = new Date(arys[0], --arys[1], arys[2], arys_time[0], arys_time[1], "");
			return myDate;
		},

		//+---------------------------------------------------
		//| 日期时间检查
		//| 格式为：YYYY-MM-DD HH:MM:SS
		//+---------------------------------------------------
		CheckDateTime: function(str){
		    var reg = /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/;
        	var r = str.match(reg);
		    if(r==null)return false;
		    return true;
		},

		//+---------------------------------------------------
		//| 取得日期数据信息
		//| 参数 interval 表示数据类型
		//| y 年 m月 d日 w星期 ww周 h时 n分 s秒
		//+---------------------------------------------------

		DatePart: function(data, interval){
			var myDate = data;
			var partStr='';
			var Week = ['日','一','二','三','四','五','六'];
			switch (interval){
				case 'y' :partStr = myDate.getFullYear();break;
				case 'm' :partStr = myDate.getMonth()+1;break;
				case 'd' :partStr = myDate.getDate();break;
				case 'w' :partStr = Week[myDate.getDay()];break;
				case 'ww' :partStr = myDate.WeekNumOfYear();break;
				case 'h' :partStr = myDate.getHours();break;
				case 'n' :partStr = myDate.getMinutes();break;
				case 's' :partStr = myDate.getSeconds();break;
			}
			return partStr;
		},

		bLength: function(str){
			if (!str) {
				return 0;
			}
			var aMatch = str.match(/[^\x00-\xff]/g);
			return (str.length + (!aMatch ? 0 : aMatch.length));
		},

		// 取得字符串的长度
		getStringLength: function(str){
			if(!str){return false;}
			str = str.replace(/\r\n/g,'\n');
			var min = 41,max = 140,surl = 20,tmp = str;
			var urls = str.match(/http:\/\/[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)+([-A-Z0-9a-z_\$\.\+\!\*\(\)\/,:;@&=\?\~\#\%]*)*/gi) || [];
			var urlCount = 0;
			for (var i = 0,len = urls.length; i < len; i++) {
				var count = this.bLength(urls[i]);
				if (/^(http:\/\/t.cn)/.test(urls[i])) {
					continue;
				} else {
					if (/^(http:\/\/)+(t.sina.com.cn|t.sina.cn)/.test(urls[i]) || /^(http:\/\/)+(weibo.com|weibo.cn)/.test(urls[i])) {
						urlCount += count <= min ? count : (count <= max ? surl : (count - max + surl));
					} else {
						urlCount += count <= max ? surl : (count - max + surl);
					}
				}
				tmp = tmp.replace(urls[i], "");
			}
			var result = Math.ceil((urlCount + this.bLength(tmp)) / 2);
			//$.log('rs = '+result);
			return result;
		},

		// 检测内容中URL地址的长度
		checkUrlength: function(content, type) {
		    var len = max = std = 0;
		    var urls = [];
		    if (type == 'sina') {
		        max = 140, std = 20;
		        urls = content.match(/https?:\/\/[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)+([-A-Z0-9a-z_\$\.\+\!\*\(\)\/,:;@&=\?\~\#\%]*)*/gi) || []
		    } else {
		        max = 257, std = 22;
		        var urlReg = RegExp(
		            "((news|telnet|nttp|file|http|ftp|https)://){1}(([-A-Za-z0-9]+(\\.[-A-Za-z0-9]+)*(\\.[-A-Za-z]{2,5}))|([0-9]{1,3}(\\.[0-9]{1,3}){3}))(:[0-9]*)?(/[-A-Za-z0-9_\\$\\.\\+\\!\\*\\(\\),;:@&=\\?/~\\#\\%]*)*",
		            "gi");
		        var result, arr;
		        while ((result = urlReg.exec(content)) != null) {
		            arr = result.toString().split(',');
		            urls.push(arr[0])
		        }
		    }

		    if (urls.length == 0) {
		        return 0
		    }

		    var de = max - std;
		    for (var i = 0, url; url = urls[i]; i++) {
		        if (url.length >= max) {
		            len += de
		        } else {
		            len += url.length - std
		        }
		    }
		    return len
		},

		length: function (a) {
	        var b = 0;
	        for (var i = 0; i < a.length; i++) {
	            if ((a.charCodeAt(i) < 0) || (a.charCodeAt(i) > 255)) {
	                b = b + 2
	            } else {
	                b = b + 1
	            }
	        }
	        return b
	    },

	    // 判断当前用户是否登陆
	    isLogined: function(){
	    	var UserId = $.mytools.getCookie("UserId");
	    	var UserName = $.mytools.getCookie("UserName");

	    	if(!UserId && !UserName){
	    		return false;
	    	}else{
	    		return true;
	    	}
	    },

		//MD5方法
		MD5: function(string) {


			function RotateLeft(lValue, iShiftBits) {

				return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));

			}

			function AddUnsigned(lX,lY) {

				var lX4,lY4,lX8,lY8,lResult;

				lX8 = (lX & 0x80000000);

				lY8 = (lY & 0x80000000);

				lX4 = (lX & 0x40000000);

				lY4 = (lY & 0x40000000);

				lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);

				if (lX4 & lY4) {

					return (lResult ^ 0x80000000 ^ lX8 ^ lY8);

				}

				if (lX4 | lY4) {

					if (lResult & 0x40000000) {

						return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);

					} else {

						return (lResult ^ 0x40000000 ^ lX8 ^ lY8);

					}

				} else {

					return (lResult ^ lX8 ^ lY8);

				}

			}


			function F(x,y,z) { return (x & y) | ((~x) & z); }

			function G(x,y,z) { return (x & z) | (y & (~z)); }

			function H(x,y,z) { return (x ^ y ^ z); }

			function I(x,y,z) { return (y ^ (x | (~z))); }


			function FF(a,b,c,d,x,s,ac) {

				a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));

				return AddUnsigned(RotateLeft(a, s), b);

			};


			function GG(a,b,c,d,x,s,ac) {

				a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));

				return AddUnsigned(RotateLeft(a, s), b);

			};


			function HH(a,b,c,d,x,s,ac) {

				a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));

				return AddUnsigned(RotateLeft(a, s), b);

			};


			function II(a,b,c,d,x,s,ac) {

				a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));

				return AddUnsigned(RotateLeft(a, s), b);

			};


			function ConvertToWordArray(string) {

				var lWordCount;

				var lMessageLength = string.length;

				var lNumberOfWords_temp1=lMessageLength + 8;

				var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64;

				var lNumberOfWords = (lNumberOfWords_temp2+1)*16;

				var lWordArray=Array(lNumberOfWords-1);

				var lBytePosition = 0;

				var lByteCount = 0;

				while ( lByteCount < lMessageLength ) {

					lWordCount = (lByteCount-(lByteCount % 4))/4;

					lBytePosition = (lByteCount % 4)*8;

					lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount)<<lBytePosition));

					lByteCount++;

				}

				lWordCount = (lByteCount-(lByteCount % 4))/4;

				lBytePosition = (lByteCount % 4)*8;

				lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition);

				lWordArray[lNumberOfWords-2] = lMessageLength<<3;

				lWordArray[lNumberOfWords-1] = lMessageLength>>>29;

				return lWordArray;

			};


			function WordToHex(lValue) {

				var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;

				for (lCount = 0;lCount<=3;lCount++) {

					lByte = (lValue>>>(lCount*8)) & 255;

					WordToHexValue_temp = "0" + lByte.toString(16);

					WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);

				}

				return WordToHexValue;

			};


			function Utf8Encode(string) {

				string = string.replace(/\r\n/g,"\n");

				var utftext = "";


				for (var n = 0; n < string.length; n++) {


					var c = string.charCodeAt(n);


					if (c < 128) {

						utftext += String.fromCharCode(c);

					}

					else if((c > 127) && (c < 2048)) {

						utftext += String.fromCharCode((c >> 6) | 192);

						utftext += String.fromCharCode((c & 63) | 128);

					}

					else {

						utftext += String.fromCharCode((c >> 12) | 224);

						utftext += String.fromCharCode(((c >> 6) & 63) | 128);

						utftext += String.fromCharCode((c & 63) | 128);

					}


				}


				return utftext;

			};


			var x=Array();

			var k,AA,BB,CC,DD,a,b,c,d;

			var S11=7, S12=12, S13=17, S14=22;

			var S21=5, S22=9 , S23=14, S24=20;

			var S31=4, S32=11, S33=16, S34=23;

			var S41=6, S42=10, S43=15, S44=21;


			string = Utf8Encode(string);


			x = ConvertToWordArray(string);


			a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;


			for (k=0;k<x.length;k+=16) {

				AA=a; BB=b; CC=c; DD=d;

				a=FF(a,b,c,d,x[k+0], S11,0xD76AA478);

				d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756);

				c=FF(c,d,a,b,x[k+2], S13,0x242070DB);

				b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE);

				a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF);

				d=FF(d,a,b,c,x[k+5], S12,0x4787C62A);

				c=FF(c,d,a,b,x[k+6], S13,0xA8304613);

				b=FF(b,c,d,a,x[k+7], S14,0xFD469501);

				a=FF(a,b,c,d,x[k+8], S11,0x698098D8);

				d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF);

				c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);

				b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE);

				a=FF(a,b,c,d,x[k+12],S11,0x6B901122);

				d=FF(d,a,b,c,x[k+13],S12,0xFD987193);

				c=FF(c,d,a,b,x[k+14],S13,0xA679438E);

				b=FF(b,c,d,a,x[k+15],S14,0x49B40821);

				a=GG(a,b,c,d,x[k+1], S21,0xF61E2562);

				d=GG(d,a,b,c,x[k+6], S22,0xC040B340);

				c=GG(c,d,a,b,x[k+11],S23,0x265E5A51);

				b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);

				a=GG(a,b,c,d,x[k+5], S21,0xD62F105D);

				d=GG(d,a,b,c,x[k+10],S22,0x2441453);

				c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681);

				b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);

				a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6);

				d=GG(d,a,b,c,x[k+14],S22,0xC33707D6);

				c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87);

				b=GG(b,c,d,a,x[k+8], S24,0x455A14ED);

				a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905);

				d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8);

				c=GG(c,d,a,b,x[k+7], S23,0x676F02D9);

				b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);

				a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942);

				d=HH(d,a,b,c,x[k+8], S32,0x8771F681);

				c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122);

				b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);

				a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44);

				d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9);

				c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60);

				b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);

				a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6);

				d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA);

				c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085);

				b=HH(b,c,d,a,x[k+6], S34,0x4881D05);

				a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039);

				d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);

				c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);

				b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665);

				a=II(a,b,c,d,x[k+0], S41,0xF4292244);

				d=II(d,a,b,c,x[k+7], S42,0x432AFF97);

				c=II(c,d,a,b,x[k+14],S43,0xAB9423A7);

				b=II(b,c,d,a,x[k+5], S44,0xFC93A039);

				a=II(a,b,c,d,x[k+12],S41,0x655B59C3);

				d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92);

				c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D);

				b=II(b,c,d,a,x[k+1], S44,0x85845DD1);

				a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F);

				d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);

				c=II(c,d,a,b,x[k+6], S43,0xA3014314);

				b=II(b,c,d,a,x[k+13],S44,0x4E0811A1);

				a=II(a,b,c,d,x[k+4], S41,0xF7537E82);

				d=II(d,a,b,c,x[k+11],S42,0xBD3AF235);

				c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB);

				b=II(b,c,d,a,x[k+9], S44,0xEB86D391);

				a=AddUnsigned(a,AA);

				b=AddUnsigned(b,BB);

				c=AddUnsigned(c,CC);

				d=AddUnsigned(d,DD);

			}


			var temp = WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);


			return temp.toLowerCase();
		},

		// 获取十位时间戳
		getTimestamp: function() {
			var timestamp = new Date().getTime().toString();
			timestamp = timestamp.slice(0,10);
			return parseInt(timestamp);
		}
	},


	$.mytools = new ToolsClass();


	// ++++++++++++++++++++++++ 自定义组件 ++++++++++++++++++++++++

	$.extend($.fn, {

		// 文字输入 字数控制
		fontSizeMonitoring: function(fontSize, isHalfAngle) {
			var _input_obj = $(this);	// 输入框对象
			if(!_input_obj){return false;}

			var _input_obj_id = _input_obj.attr("id");

			var _fontSizeInput = _input_obj.siblings("[data-fontSizeBind="+_input_obj_id+"]");	// 与输入框绑定的字数输出对象
			_fontSizeInput.find("em").text(fontSize);

			_input_obj.bind('input propertychange', function() {
				runEvent($(this));
			});

			runEvent(_input_obj);

			function runEvent(obj){
				var currentFontSize = isHalfAngle ? $(obj).val().length : $.mytools.getStringLength($(obj).val());
				_fontSizeInput.find("em").text(fontSize - currentFontSize);
				if(fontSize - currentFontSize < 0){
					_fontSizeInput.html('已经超出<em style="color: #E74C3C;">'+((fontSize - currentFontSize) * -1)+'</em>个字');
				}else{
					_fontSizeInput.html('还可以输入<em>'+(fontSize - currentFontSize)+'</em>个字');
				}

				// var strlen = $.mytools.length($(obj).val()) - $.mytools.checkUrlength($(obj).val(), "sina");
				// var num = fontSize - Math.ceil(strlen / 2);
				// if (num < 0) {
				// 	_fontSizeInput.html('已超出 <em style="color: #E74C3C;">' + Math.abs(num) + '</em> 个字');
				// } else if (num >= 0 && num <= 10) {
				// 	_fontSizeInput.html('还可以输入 <em">' + Math.ceil(num) + '</em> 个字');
				// } else {
				// 	_fontSizeInput.html('还可以输入 <em>' + Math.ceil(num) + '</em> 个字');
				// }
			}
		},



	});


})(jQuery)
