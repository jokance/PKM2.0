$(function(){
	//从数据库中取出10条问题，如果问题数量小于10，说明回答没有更多，隐藏
	if($('.qustion').length<10){
		$('.ask_more').hide();
	}
	//查看更多问题
	$('input[name=jishu]').val('0');
	//查看更多回答
	$('.ask_more').click(function(){
		var qusid=$('input[name=qusid]').val();
		
		var jishu=$('input[name=jishu]');
		
		$.ajax({
			type:'post',
			url:ROOT+'/Public/ask',
			data:'act=getask'+'&asknum='+jishu.val(),
			success:function(text){
				if(text==1){
					//没有更多
					$('.ask_more a').html('没有更多');
				}else{
					$('.newask').before(text);
					jishu.val(parseInt(jishu.val())+1)
				}
				
				//每点击一次计算就加1
				
			}
		});
	});
	

});
//文本框事件
//function myfocus(_this){
//	$(_this).val();
//}
//
//function myblur(_this){
//	if($(_this).val()=='') $(_this).val('请在这里添加答案...');
//	
//}
//我要回答
function comment(_this){
	var index=$('.question .comment .myans').index(_this);
	if($('.postans').eq(index).height()==0){
		$(_this).html('收起回答');
		$('.postans').eq(index).width('700').animate({
			height:120,
		});
	}else{
		$(_this).html('我要回答');
		$('.postans').eq(index).animate({
			height:0,
		},'normal','linear',function(){
			$('.postans').eq(index).width(0);
		});
	}
	
	return false;
}
//提交答案
function sendans(_this){
	var index=$('input.send').index(_this);
	var text=$('textarea[name=text]').eq(index).val();
	if(text==''){
		return false;
	}
	
	$.ajax({
		type:'post',
		url:ROOT+'/Public/post4',
		data:$('form[name=postans]').eq(index).serialize(),
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
				$('textarea[name=text]').val('');
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
}

