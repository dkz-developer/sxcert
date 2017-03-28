/**
 * 浏览器版本过低提示
 * @authors SX
 * @date    2015-09-09 22:23:25
 */
;(function(){
	var css = ".kol-browserTips{position: absolute; top: 0; width: 100%; height: 60px; line-height: 60px; background: #d9534f; border-bottom: 1px #d43f3a solid; color: #fff; font-size: 16px; text-align: center; z-index: 99999;}.kol-browserTips i{font-size: 20px;}";
	var code = '<div class="kol-browserTips"><i class="fa fa-frown-o"></i> &nbsp;非常抱歉, 您的浏览器版本过低, 无法给您提供优质的服务了, 建议您使用360安全浏览器或者提高IE浏览器版本, 谢谢您的支持!</div>';

	$("head").append("<style>"+css+"</style>");
	$("body").prepend(code);

})()
