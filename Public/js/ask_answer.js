$(function(){
	//从数据库中取出5条回答，如果回答数量小于5，说明回答没有更多，隐藏
	if($('.detail').length<5){
		$('.ans_more').hide();
	}
	//我要回答
	$('.tag .comment a').click(function(){
		if($('.postans').height()==0){
			$(this).html('收起回答');
			$('.postans').width('700').animate({
				height:120,
			});
		}else{
			$(this).html('我要回答');
			$('.postans').animate({
				height:0,
			},'normal','linear',function(){
				$('.postans').width(0);
			});
		}
		
	});
	
	//回答框初始化
	$('textarea[name=text]').focus(function(){
		$(this).val('');
	}).blur(function(){
		if($(this).val()=='') $(this).val('请在这里添加答案...');
	});
	
	//提交答案
	$('input.send').click(function(){
		var text=$('textarea[name=text]').val();
		if(text==''||text=='请在这里添加答案...'){
			return false;
		}
		
		$.ajax({
			type:'post',
			url:ROOT+'/Public/post4',
			data:$('form[name=postans]').serialize(),
			success:function(text){
				
				if(text==1){
					$('#error').show();
					center($('#error'));
					$('#error p').html('请先登录！');
					setTimeout(function () {
						$('#error').hide();
					}, 1500);
				}else if(text==2){
					$('#success').show();
					center($('#success'));
					$('#success p').html('回答提交成功...');
					$('textarea[name=text]').val('请在这里添加答案...');
					setTimeout(function () {
						$('#success').hide();
					}, 1500);
				}else if(text==3){
					$('#error').show();
					center($('#error'));
					$('#error p').html('回答提交失败，请重新提交！');
					setTimeout(function () {
						$('#error').hide();
					}, 1500);
				}
			},
			async:true,
		});
		
		return false;
	});
	
	$('input[name=jishu]').val('0');
	//查看更多回答
	$('.ans_more').click(function(){
		var qusid=$('input[name=qusid]').val();
		
		var jishu=$('input[name=jishu]');
		
		$.ajax({
			type:'post',
			url:ROOT+'/Public/answer',
			data:'qusid='+qusid+'&ansnum='+jishu.val(),
			success:function(text){
				//alert(text);
				if(text==1){
					//没有更多
					$('.ans_more a').html('没有更多');
				}else{
					$('.newans').before(text);
					jishu.val(parseInt(jishu.val())+1)
				}
				
				//每点击一次计算就加1
				
			}
		});
	});
	
	
	
	
});