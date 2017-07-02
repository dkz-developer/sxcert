

(function($) {
	// 获取最大分页
	var maxPage = parseInt($('#maxPage').val());
	if(0 >= maxPage)	
		maxPage = 1;
	$(function() {
		// 当用户回复时滚动到指定位置
		if($('#lastReply').length > 0) {
			$('html, body').animate({  
				scrollTop: $('#lastReply').offset().top  
			}, 2000);
		}

		var ue = UE.getEditor('pubContent');

		$(".reply-list-item").find(".bottom .scroll").click(function() {

			ue.focus();

			$('html, body').animate({  
				scrollTop: $('#reply').offset().top  
			}, 100);
		})
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
		$(this).css('color','#ccc');
		$.get('/like/'+id,function(msg){
			if(msg.code == 'S') {
				var linke_num = $('#goods'+id).text();
				$('#goods'+id).text(parseInt(linke_num)+1);
				$('#addlike'+id).css('left',offset.left+'px');
				$('#addlike'+id).show('slow');
				setTimeout(function(){
					$('#addlike'+id).hide('slow');
				},2000);
			}

		});
	});
	// 回帖
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
				}else if('A' == data.code){
					window.location.href = '/login';
				}else{
					layer.msg(data.msg,{icon:2,time:2000,offset: "30%"});
				}
			},
			error:function(data) {
				layer.msg('好抱歉，系统好像出错了，请联系网站管理员！',{icon:2,time:3000});
			},
		});
		return false;
	});

	// 回复评论设置回复id
	$('.reply_comment').click(function(){
		$('#reply_id').val(parseInt($(this).attr('reply_id')));
	});

	// 购买文章
	$('#buyArticle').click(function(){
		var id = parseInt($(this).attr('data_id'));
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'POST',
			url: '/buyArticle',
			data: {'id':id},
			dataType: 'json',
			success: function(data){
				if(data.code == 'S') {
					layer.msg(data.msg,{icon:1,time:2000});
					setTimeout(function(){
						window.location.reload();
					},2000);
				}else if('F' == data.code){
					layer.msg(data.msg,{icon:2,time:2000});
					setTimeout(function(){
						window.location.href=data.url;
					},2000);
				}else{
					layer.msg(data.msg,{icon:2,time:2000,offset: "30%"});
				}
			},
			error:function(data) {
				layer.msg('好抱歉，系统好像出错了，请联系网站管理员！',{icon:2,time:3000});
			},
		});
	});


})(jQuery)