$(function(){
	//添加好友
	$('.addf').click(function(){
		var index=$('.addf').index(this);
		var touser=$('.recuser').eq(index).html();
		$.ajax({
			type:'post',
			url:ROOT+'/Friend/addf',
			data:'touser='+$.trim(touser),
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
					$('#success p').html('好友添加成功，等待验证');
					window.location.reload();	//重载页面
//					setTimeout(function () {
//						$('#success').hide();
//					}, 1500);
				}else if(text==3){
					$('#error').show();
					center($('#error'));
					$('#error p').html('好友添加失败，请重新添加');
					setTimeout(function () {
						$('#error').hide();
					}, 1500);
				}else if(text==4){
					$('#error').show();
					center($('#error'));
					$('#error p').html('对不起，你们已经是好友了');
					setTimeout(function () {
						$('#error').hide();
					}, 1500);
				}
			},
			async:true,
		});
	});
});