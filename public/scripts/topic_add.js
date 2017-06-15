

(function($) {


    $(function() {

    	var ue = UE.getEditor('pubContent');

	$('#isNeedMoney').change(function(){
		if($(this).is(':checked')){
			$('#inputMoney').show();
		}else{
			$('#inputMoney').hide();
		}
	});

	/**
	 * 添加文章
	 */
	$('#addArticle').submit(function(){
		// 判断标题长度
		var title_len = $('#title').val().length;
		if(title_len < 1 || title_len > 50) {
			layer.msg('主题格式为1~50个字符！');
			return false;
		}
		// 判断正文是否输入
		var is_input = ue.hasContents();
		if(!is_input) {
			layer.msg('请输入正文！');
			return false;
		}
		// 判断是否要金额以及金额是否合法
		if ($('#isNeedMoney').is(':checked') ) {
			var money = parseInt($('#money').val());
			if(isNaN(money) || money <= 0) {
				layer.msg('请输入查看所需金币个数！');
				return false;
			}
		}
		return true;
	});
    });

})(jQuery)