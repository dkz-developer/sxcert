

(function($) {
	// 获取最大分页
	var maxPage = parseInt($('#maxPage').val());
	$(function() {
		// 当用户回复时滚动到指定位置
		if($('#lastReply').length > 0) {
			$('html, body').animate({  
		                    scrollTop: $('#lastReply').offset().top  
		           }, 2000);
		}

		var ue = UE.getEditor('pubContent');
	});

	/**
	 * 点赞
	 * @author JieJie
	 */
	$('.goods').click(function(){
		var id = parseInt($(this).attr('article_id'));
		if(isNaN(id) || id < 0)
			return false;
		var offset = $(this).offset();
		$.get('/like/'+id,function(msg){
			if(msg.code == 'S') {
				//var html = '<div style="height:50px;width:50px;border:1px solid #03978b;color:#03978b;position:absolute;left:'+offset.left+'px;top:'+offset.top+'px"> +1</div>';
				//document.write(html);
			}

		});
	});

	/**
	 * 回帖
	 */
	$('#reply').submit(function(){
		var params = $(this).serialize();
		var parentId = parseInt($('#parent_id').val());
		$.ajax({
			headers: {
	    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    		},
			type: 'POST',
			url: '/reply',
			data: params,
			dataType: 'json',
			success: function(data){
				if(data.code == 'S') {
					layer.msg(data.msg,{icon:1,time:2000});
					setTimeout(function(){
						window.location.href="/thread/topic/"+parentId+"?page="+maxPage+'&replyId='+data.data;
					},2000);
				}else {
					layer.msg(data.msg,{icon:2,time:2000});
				}
			},
			error:function(data) {
				layer.msg('好抱歉，系统好像出错了，请联系网站管理员！',{icon:2,time:3000});
			},
		});
		return false;
	});
})(jQuery)