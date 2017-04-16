/**
 * @authors SX
 * @date    2014-08-07 13:31:41
 * @explain 前端工具集合 PS；维护人员；注意保证每个方法的独立性与通用性
 */

// ------------------------自定义的工具类------------------------

// 按需加载JS文件
function requireScript(scriptId, scriptName, initFun){
	var body = document.getElementsByTagName('body')[0];
	var oldScript = document.getElementById(scriptId);
	if (oldScript) {
		try{
			// 如果JS脚本已经存在,则不在重新加载文件,直接执行文件中的通用方法RunScript
			initFun();
		}catch(e){
			// throw new Error(scriptName+" 脚本中没有初始化方法,无法运行脚本! 请检查脚本!");
		}
	}else{
		var newScript = document.createElement('script');
		newScript.charset = 'utf-8';
		newScript.id = scriptId;
		newScript.type = 'text/javascript';
		newScript.src = getContextUrlForScript()+scriptName;
		body.appendChild(newScript);
	}
}

// 获取页面滚动条数据
function GetPageScroll(win) {
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
}

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

// 取得数组中最大值
Array.prototype._getMaxVal = function(){
	return Math.max.apply({},this);
}

// 取得数组中最小值
Array.prototype._getMinVal = function(){
	return Math.min.apply({},this);
}

// 向数组中加入项(有查重功能)
Array.prototype._addItem = function(item){
	if(this.length <= 0){this.push(item); return false;}
	for(var i=0,len=this.length; i<len; i++){
		if(this[i] === item){
			return false;
		}else{
			this.push(item);
			break;
		}
	}
}

// 删除数组中指定的项
Array.prototype._removeItem = function(item){
	for(var i=0,len=this.length; i<len; i++){
		if(this[i] === item){
			this.splice(i, 1);
		}
	}
}

// 数组去重复
Array.prototype._unique = function(){
	var n = {},r=[]; //n为hash表，r为临时数组
	for(var i = 0; i < this.length; i++) //遍历当前数组
	{
		if (!n[this[i]]) //如果hash表中没有当前项
		{
			n[this[i]] = true; //存入hash表
			r.push(this[i]); //把当前数组的当前项push到临时数组里面
		}
	}
	return r;
}

// 删除字符串中的前后空格
String.prototype._trim = function(){
	return this.replace(/(^\s*)|(\s*$)/g, "");
}

// 删除字符串中的所有空格
String.prototype._trimAll = function(){
	return this.replace(/\s/g,"");
}

// 删除字符串中的左侧空格
String.prototype._ltrim = function(){
	return this.replace(/(^\s*)/g, "");
}

// 删除字符串中的右侧空格
String.prototype._rtrim = function(){
	return this.replace(/(\s*$)/g, "");
}

// ------------------------字符串验证通用方法------------------------
/*
** 用途：检查输入字符串是否为空或者全部都是空格
** 输入：str
** 返回：如果全是空返回true,否则返回false
*/
function isNull(str){
    if(str == ""){
      return true;
    }else if(str == "null" || str === null){
      return true;
    }
    var regu = "^[ ]+$";
    var re = new RegExp(regu);
    return re.test(str);
}

/*
** 用途：检查输入的Email信箱格式是否正确
** 输入：strEmail：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function checkEmail(strEmail){
	var emailReg = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/;
    if(emailReg.test(strEmail)){
        return true;
    }else{
        return false;
    }
}

/*
** 用途：检查输入手机号码是否正确
** 输入：strMobile：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function checkMobile(strMobile){
    var regu = /^[1][1-9][0-9]{9}$/;
    var re = new RegExp(regu);
    if (re.test(strMobile)) {
        return true;
    }else{
        return false;
    }
}

/*
** 用途：检查输入字符串是否只由英文字母和数字和下划线组成
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isNumberOr_Letter(str){
    var regu = "^[0-9a-zA-Z\_]+$";
    var re = new RegExp(regu);
    if(re.test(str)){
        return true;
    }else{
        return false;
    }
}

/*
** 用途：检查输入字符串是否纯数字
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isNumber(str){
    var regu = "^[0-9]+$";
    var re = new RegExp(regu);
    if(re.test(str)){
        return true;
    }else{
        return false;
    }
}


/*
 ** 用途：检查输入的qq是否邮箱格式
 ** 输入：str：字符串
 ** 返回：如果通过验证返回true,否则返回false
 */
function checkqqEmail(strEmail){
	var regu = /^[a-zA-Z][A-Za-z0-9\.|-|_]+[A-Za-z0-9]+@[qQ][qQ]\.com$/;
	if(regu.test(strEmail)){
		return true;
	}else{
		return false;
	}
}


/*
** 用途：检查输入字符串是否是负数
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isNegativeNumber(str){
    var regu = "^[-0-9]+$";
    var re = new RegExp(regu);
    if(re.test(str)){
        return true;
    }else{
        return false;
    }
}

/*
** 用途：检查输入字符串是否是负数
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isNegativeFloat(str){
    var regu = "^[-0-9\.]+$";
    var re = new RegExp(regu);
    if(re.test(str)){
        return true;
    }else{
        return false;
    }
}

/*
** 用途：检查输入字符串是否flaot型数字
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isFloat(str){
    var regu = "^[0-9\.]+$";
    var re = new RegExp(regu);
    if(re.test(str)){
        return true;
    }else{
        return false;
    }
}

/*
** 用途：检查输入字符串是否数字和字母组成
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isNumberOrLetter(str){
    var regu = "^[0-9a-zA-Z]+$";
    var re = new RegExp(regu);
    if(re.test(str)){
        return true;
    }else{
        return false;
    }
}

/*
** 用途：检查输入字符串是否含有中文
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isHasChinese(str){
	var regu = "[\u4e00-\u9fa5]";
    var re = new RegExp(regu);
    if(re.test(str)){
        return true;
    }else{
        return false;
    }
}

/*
** 用途：检查输入字符串是否只有中文
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isOnlyChinese(str){
  var regu = "^[\u4e00-\u9fa5]+$";
  var re = new RegExp(regu);
  if(re.test(str)){
      return true;
  }else{
      return false;
  }
}

/*
** 用途：检查输入字符串是否为有效的身份证号
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isCardNo(card){
   // 身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X
   var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
   if(reg.test(card)){
       return true;
   }else{
      return false;
   }
}

/*
** 用途：检查输入字符串是否以字母开头
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function isLetterStart(str){
    var regu = "^[a-zA-Z]";
    var re = new RegExp(regu);
    if(re.test(str)){
        return true;
    }else{
        return false;
    }
}

/*
** 用途：检查输入的字符串的长度是否符合标准
** 输入：str：字符串 minNum:最小长度 maxNum:最大长度
** 返回：如果通过验证返回true,否则返回false
*/
function checkLength(str, minNum, maxNum){
	if(str.length >= minNum && str.length <= maxNum){
		return true;
	}else{
		return false;
	}
}

/*
** 用途：剔除字符串中的敏感字符,防止script代码注入
** 输入：str：字符串
** 返回：如果通过验证返回true,否则返回false
*/
function stripScript(str){
	var pattern = new RegExp("[&*<>;]");
	var rs = "";
	for (var i = 0; i < str.length; i++) {
	 rs = rs+str.substr(i, 1).replace(pattern, '');
	}
	return rs;
}

/*
** 用途：查看字符串的字节数
** 输入：str：字符串
** 返回：字节数
*/
function getBytesLength(str) {
	// 在GBK编码里，除了ASCII字符，其它都占两个字符宽
	return str.replace(/[^\x00-\xff]/g, 'xx').length;
}

/*
 ** 用途：获取昨天时间对应当年的第一天时间节点
 ** 返回：时间字节
 */
function getYearfirstDay() {
	var yestoday = new Date(new Date().getTime() - 86400000);
	var y 		 = yestoday.getFullYear();
	return y + "-" + "01" + "-" + "01";
}

/*
 ** 用途：获取昨天时间节点
 ** 返回：时间字节
 */
function getYesterDay() {
	var yestoday = new Date(new Date().getTime() - 86400000);
	var y 	     = yestoday.getFullYear();
	var m        = yestoday.getMonth() + 1;
	var d    	 = yestoday.getDate();
	if(m < 10) m = "0" + m;
	if(d < 10) d = "0" + d;
	return y + "-" + m + "-" + d;
}

// ------------------------cookie操作------------------------
/*
** 用途：向浏览器添加cookie
** 输入：objName : 存入的cookie名称  |  objValue : 对应的cookie值  |  objHours : cookie保存时间
** 返回：无返回值
*/
function addCookie(objName,objValue,objHours){
	var str = objName + "=" + escape(objValue);
	if(objHours > 0){//为0时不设定过期时间，浏览器关闭时cookie自动消失
		var date = new Date();
		var ms = objHours*3600*1000;
		date.setTime(date.getTime() + ms);
		str += "; expires=" + date.toGMTString();
	}
	document.cookie = str;
}

/*
** 用途：根据cookie名称取得cookie值
** 输入：objName : cookie名称
** 返回：与cookie名称对应的cookie值(如果存在的话)
*/
function getCookie(objName){
	var arrStr = document.cookie.split("; ");
	for(var i = 0;i < arrStr.length;i ++){
		var temp = arrStr[i].split("=");
		if(temp[0] == objName){
			return unescape(temp[1]);
		}
	}
	return null;
}

/*
** 用途：根据cookie名称删除cookie
** 输入：objName : cookie名称
** 返回：无返回值
*/
function delCookie(objName){
	var date = new Date();
	date.setTime(date.getTime() - 10000);
	document.cookie = objName + "=a; expires=" + date.toGMTString();
}

/*
** 用途：取得浏览器中的所有cookie
** 输入：无
** 返回：所有cookie的字符串
*/
function allCookie(){
	return document.cookie;
}

/*
** 用途：传入范围,在范围内生成随机数
** 输入：Min：最小数	Max：最大数
** 返回：随机数
*/
function GetRandomNum(Min,Max){
  var Range = Max - Min;
  var Rand = Math.random();
  return(Min + Math.round(Rand * Range));
}

/*
** 用途：取得地址中的参数
** 输入：name: key值
** 返回：key值对应的值
*/
function GetQueryString(name){
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

}

//MD5方法
function MD5(string) {


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
}

// 获取十位时间戳
function getTimestamp() {
	var timestamp = new Date().getTime().toString();
	timestamp = timestamp.slice(0,10);
	return parseInt(timestamp);
}