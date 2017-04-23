

(function($) {

	// 表单验证
	function verifyForm(){
		var brand = $("#brand"),	// 品牌
			model = $("#model"),	// 机型
			country = $("#country"),	// 国家
			os = $("#os"),	// OS
			type = $("#type"),	// 类型
			price = $("#price"),	// 单价
			version = $("#version"),	// 版本
			download_url = $("#url"),	// 下载地址
			download_password = $("#note");	// 备注

		var submitInfo = {};

		if(isNull(brand.val())) {
			showErrorInfo(brand,"请选择一个品牌",true);
			return false;
		}else {
			submitInfo["brand"] = brand.val();
		}

		if(isNull(model.val())) {
			showErrorInfo(model,"请选择一个机型",true);
			return false;
		}else {
			submitInfo["model"] = model.val();
		}

		if(isNull(country.val())) {
			showErrorInfo(country,"请选择一个国家",true);
			return false;
		}else {
			submitInfo["country"] = country.val();
		}

		if(isNull(os.val())) {
			showErrorInfo(os,"请选择一个版本",true);
			return false;
		}else {
			submitInfo["os"] = os.val();
		}

		if(isNull(type.val())) {
			showErrorInfo(type,"请选择一个类型",true);
			return false;
		}else {
			submitInfo["type"] = type.val();
		}

		if(isNull(price.val())) {
			showErrorInfo(price,"价格不能为空");
			return false;
		}else {
			submitInfo["price"] = price.val();
		}

		if(isNull(version.val())) {
			showErrorInfo(version,"版本号不能为空");
			return false;
		}else {
			submitInfo["version"] = version.val();
		}

		if(isNull(download_url.val())) {
			showErrorInfo(url,"下载地址不能为空");
			return false;
		}else if(is.not.url(download_url.val())) {
			showErrorInfo(url,"下载地址格式不正确");
			return false;
		}else {
			submitInfo["download_url"] = download_url.val();
		}

		if(isNull(download_password.val())) {
			showErrorInfo(download_password,"备注不能为空");
			return false;
		}else {
			submitInfo["download_password"] = download_password.val();
		}


		return submitInfo;
	}

	// 显示错误信息
	function showErrorInfo(obj,errorinfo,flag){
		var inputObj = flag ? $("button[data-id="+obj.attr("id")+"]") : obj;
		layer.tips(errorinfo, inputObj ,{tips: [2, '#333'],time: 4000});
	}

	// 表单提交
	function submitInfo() {


		$("#submitBtn").click(function() {

			var _this = $(this);
			var submitInfo = verifyForm();

			if(submitInfo) {

	            submitInfo["_token"] = $("#app").attr("data-value");

				_this.html('<i class="fa fa-spinner fa-pulse"></i>&nbsp;提交中...');

				$.post("/addUserInfo", submitInfo, function(backData) {
	                if(backData && backData.code === "S"){
	                	window.location.href = "/rom";
	                }else{
	                    layer.msg(backData.msg);
	                    _this.html('<i class="fa fa-pencil"></i> 提交');
	                }
	            }, "json")
			}
			
		})
	}
    
    $(function() {

		// 表单提交
    	submitInfo();

    });

})(jQuery)