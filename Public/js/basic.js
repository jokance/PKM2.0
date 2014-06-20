$(function(){

	var doc=document.body || document.documentElement;
	//画布遮罩
	var screen = $('#screen');
	//登录框
	var login = $('#login');
	//画布设置

	//设置登陆框居中
	$(window).resize(function () {
		if(login.css('display')=='block'){
			center(login);
		}
	});
	//点击弹出登陆框
	$('#top .login').click(function(){
		doc.style.overflow='hidden';
		center(login);
		login.show();
		lock(screen);
	});
	//点击关闭登陆框
	$('#login .close').click(function(){
		doc.style.overflow='auto';
		login.hide();
		unlock(screen);
	});
	
	//注册框
	var reg = $('#reg');
	$(window).resize(function () {
		if (reg.css('display') == 'block') {
			center(reg);
		}
	});
	$('#top .register').click(function () {
		doc.style.overflow='hidden';
		center(reg);
		reg.show();
		lock(screen);

	});
	$('#reg .close').click(function () {
		doc.style.overflow='auto';
		reg.hide();
		unlock(screen);
	});
	
	//初始化注册表单
	document.reg.reset();
	//用户验证
	$('input[name=user]').eq(0).focus(function(){
		$('#reg .info_user').show();
		$('#reg .error_user').hide();
		$('#reg .succ_user').hide();	
	}).blur(function(){
		if ($.trim($(this).val()) == '') {
			$('#reg .info_user').hide();
			$('#reg .error_user').hide();
			$('#reg .succ_user').hide();
		} else if (!check_user()) {
			$('#reg .error_user').show();
			$('#reg .info_user').hide();
			$('#reg .succ_user').hide();
		}else {
			$('#reg .succ_user').show();
			$('#reg .error_user').hide();
			$('#reg .info_user').hide();
		}		
	});
	
	//密码验证
	$('input[name=pass]').eq(0).focus(function () {
		$('#reg .info_pass').show();
		$('#reg .error_pass').hide();
		$('#reg .succ_pass').hide();
	}).blur(function () {
		if ($.trim($(this).val()) == '') {
			$('#reg .info_pass').hide();
		} else {
			if (check_pass()) {
				$('#reg .info_pass').hide();
				$('#reg .error_pass').hide();
				$('#reg .succ_pass').show();
			} else {
				$('#reg .info_pass').hide();
				$('#reg .error_pass').show();
				$('#reg .succ_pass').hide();
			}
		}
	});
	
	//密码强度验证
	$('input[name=pass]').eq(0).keyup(function () {
		check_pass();
	});
	
	//密码确认
	$('input[name=notpass]').focus(function () {
		$('#reg .info_notpass').show();
		$('#reg .error_notpass').hide();
		$('#reg .succ_notpass').hide();
	}).blur(function () {
		if ($.trim($(this).val()) == '') {
			$('#reg .info_notpass').hide();
		} else if (check_notpass()){
			$('#reg .info_notpass').hide();
			$('#reg .error_notpass').hide();
			$('#reg .succ_notpass').show();
		} else {
			$('#reg .info_notpass').hide();
			$('#reg .error_notpass').show();
			$('#reg .succ_notpass').hide();
		}
	});
	
	//提问
	$('select[name=ques]').change(function () {
		if (check_ques()) $('#reg .error_ques').hide();

	});
	function check_ques() {
		if ($('select[name=ques]').val() != 0)return true;
	}
	//回答
	$('input[name=ans]').focus(function () {
		$('#reg .info_ans').show();
		$('#reg .error_ans').hide();
		$('#reg .succ_ans').hide();
	}).blur(function () {
		if ($.trim($(this).val()) == '') {
			$('#reg .info_ans').hide();
		} else if (check_ans()) {
			if(!check_ques()){
				$('#reg .error_ques').show()
				$('#reg .info_ans').hide();
				$('#reg .error_ans').hide();
				$('#reg .succ_ans').hide();
			}else{
				$('#reg .error_ques').hide()
				$('#reg .info_ans').hide();
				$('#reg .error_ans').hide();
				$('#reg .succ_ans').show();
			}
		} else {
			if(!check_ques()){
				$('#reg .error_ques').show()
				$('#reg .info_ans').hide();
				$('#reg .error_ans').hide();
				$('#reg .succ_ans').hide();		
			}else{
				$('#reg .error_ques').hide()
				$('#reg .error_ques').hide()
				$('#reg .info_ans').hide();
				$('#reg .error_ans').show();
				$('#reg .succ_ans').hide();
			}

		}
	});
	function check_ans() {
		if ($.trim($('input[name=ans]').val()).length >= 2 && $.trim($('input[name=ans]').val()).length <= 32) return true;
	}
	
	//电子邮件
	$('input[name=email]').focus(function () {
	
		//补全界面
		if ($(this).val().indexOf('@') == -1) $('#reg .all_email').show();
	
		$('#reg .info_email').show();
		$('#reg .error_email').hide();
		$('#reg .succ_email').hide();
	}).blur(function () {
	
		//补全界面
		$('#reg .all_email').hide();
	
		if ($.trim($(this).val()) == '') {
			$('#reg .info_email').hide();
		} else if (check_email()) {
			$('#reg .info_email').hide();
			$('#reg .error_email').hide();
			$('#reg .succ_email').show();
		} else {
			$('#reg .info_email').hide();
			$('#reg .error_email').show();
			$('#reg .succ_email').hide();
		}
	});
	function check_email() {
		if (/^[\w\-\.]+@[\w\-]+(\.[a-zA-Z]{2,4}){1,2}$/.test($.trim($('input[name=email]').val()))) return true;
	}
	
	//电子邮件补全系统键入
	$('input[name=email]').keyup(function (event) {
		if ($(this).val().indexOf('@') == -1) {
			$('#reg .all_email').show();
			$('#reg .all_email li span').html($(this).val());
		} else {
			$('#reg .all_email').hide();
		}
		
		$('#reg .all_email li').css('background', 'none');
		$('#reg .all_email li').css('color', '#666');
		
		if (event.keyCode == 40) {
			
			if (this.index == undefined || this.index >= $('#reg .all_email li').length - 1) {
				this.index = 0;
			} else {
				this.index++;
			}
			$('#reg .all_email li').eq(this.index).css('background', '#e5edf2').css('color', '#369');
			
		}
		
		if (event.keyCode == 38) {
			if (this.index == undefined || this.index <= 0) {
				this.index = $('#reg .all_email li').length - 1;
			} else {
				this.index--;
			}
			$('#reg .all_email li').eq(this.index).css('background', '#e5edf2').css('color', '#369');
			
		}
		
		
		if (event.keyCode == 13) {
			$(this).val($('#reg .all_email li').eq(this.index).text());
			$('#reg .all_email').hide();
			this.index = undefined;
		}
		
	});
	
	//电子邮件补全系统点击获取
	$('#reg .all_email li').mousedown( function () {
		$('input[name=email]').val($(this).text());
	});
	//电子邮件补全系统鼠标移入移出效果
	$('#reg .all_email li').hover(function () {
		$(this).css('background', '#e5edf2');
		$(this).css('color', '#369');
	}, function () {
		$(this).css('background', 'none');
		$(this).css('color', '#666');
	});
	
	//年月日
	var year = $('select[name=year]');
	var month = $('select[name=month]');
	var day = $('select[name=day]');
	
	var day30 = [4, 6, 9, 11];
	var day31 = [1, 3, 5, 7, 8, 10, 12];
	
	//注入年
	for (var i = 1950; i <= 2013; i ++) {
		year.get(0).add(new Option(i, i), undefined);
	}
	//注入月
	for (var i = 1; i <= 12; i ++) {
		month.get(0).add(new Option(i, i), undefined);
	}
	year.change(select_day);
	month.change(select_day);
	day.change(function () {
		if (check_birthday()) $('#reg .error_birthday').hide();
	});
	function check_birthday() {
		if (year.val() != 0 && month.val() != 0 && day.val() != 0) return true;
	}
	function select_day() {
		if (year.val() != 0 && month.val() != 0) {
			
			//清理之前的注入
			day.get(0).options.length = 1;
			
			//不确定的日
			var cur_day = 0;
			
			//注入日
			if (inArray(day31,parseInt(month.val()))) {
				cur_day = 31;
			} else if (inArray(day30,parseInt(month.val()))) {
				cur_day = 30;
			} else {
				if ((parseInt(year.val()) % 4 == 0 && parseInt(year.val()) % 100 != 0) || parseInt(year.val()) % 400 == 0) {
					cur_day = 29;
				} else {
					cur_day = 28;
				}
			}
			
			for (var i = 1; i <= cur_day; i ++) {
				day.get(0).add(new Option(i, i), undefined);
			}
			
		} else {
			//清理之前的注入
			day.get(0).options.length = 1;
		}
	}
	
	//备注
	$('textarea[name=ps]').keyup(check_ps).on('paste',function(){
		//粘贴事件会在内容粘贴到文本框之前触发
		setTimeout(check_ps, 50);
	});
	
	//清尾
	$('#reg .ps .clear').click(function () {
		$('textarea[name=ps]').val($('textarea[name=ps]').val().substring(0,200));
		check_ps();
	});
	
	function check_ps() {
		var num = 200 - $('textarea[name=ps]').val().length;
		if (num >= 0) {
			$('#reg .ps').eq(0).show();
			$('#reg .ps .num').eq(0).html(num);
			$('#reg .ps').eq(1).hide();
			return true;
		} else {
			$('#reg .ps').eq(0).hide();
			$('#reg .ps .num').eq(1).html(Math.abs(num)).css('color', 'red');
			$('#reg .ps').eq(1).show();
			return false;
		}
	}
	
	//提交
	$('input[name=sub]').eq(0).click(function () {
		var flag = true;
	
		if (!check_user()) {
			$('#reg .error_user').show();
			flag = false;
		}
		
		if (!check_pass()) {
			$('#reg .error_pass').show();
			flag = false;
		}
		
		if (!check_notpass()) {
			$('#reg .error_notpass').show();
			flag = false;
		}
		
		if (!check_ques()) {
			$('#reg .error_ques').show();
			flag = false;
		}
		
		if (!check_ans()) {
			$('#reg .error_ans').show();
			flag = false;
		}
		
		if (!check_email()) {
			$('#reg .error_email').show();
			flag = false;
		}
		
		if (!check_birthday()) {
			$('#reg .error_birthday').show();
			flag = false;
		}
		
		if (!check_ps()) {
			flag = false;
		}
	
		if (flag) {
			var _this = this;
			$('#loading').show();
			center($('#loading'));
			$('#loading p').html('正在提交注册中...');
			_this.disabled = true;
			$(_this).css('backgroundPosition', 'right');
			$.ajax({
				type : 'post',
				url : ROOT+'/Public/add',
				data : $('form[name=reg]').serialize(),
				success : function (text) {
					if (text == 1) {
						$('#loading').hide();
						$('#success').show();
						center($('#success'));
						$('#success p').html('注册成功，请登录...');
						setTimeout(function () {
							$('#success').hide();
							reg.hide();
							$('#reg .succ').hide();
							$('form[name=reg]').get(0).reset();
							_this.disabled = false;
							$(_this).css('backgroundPosition', 'left');
							unlock(screen);
						}, 1500);
					}else{
						$('#loading').hide();
						_this.disabled = false;
						$(_this).css('backgroundPosition', 'left');
						alert(text);
					}
				},
				async : true
			});
		}
		
	});
	
	//登陆表单初始化
	$('form[name=login]').get(0).reset();
	//登陆
	$('input[name=sub]').eq(1).click(function () {
		var value=$.trim($('input[name=user]').eq(1).val());
		var value_length=value.length;
		if ( value_length>=2 && value_length<=20 && $('input[name=pass]').eq(1).val().length >= 6) {
			var _this = this;
			$('#loading').show();
			center($('#loading'));
			$('#loading p').html('正在尝试登录...');
			_this.disabled = true;
			$(_this).css('backgroundPosition', 'right');

			$.ajax({
				type : 'post',
				url : ROOT+'/Check/is_login',
				data : $('form[name=login]').serialize(),
				success : function (text) {
					$('#loading').hide();
					if (text == 1) {	  //失败
						$('#login .info').html('登录失败：用户名或密码不正确！');
					} else {  //成功
						$('#login .info').html('');
						$('#success').show();
						center($('#success'));
						$('#success p').html('登录成功，请稍后...');
			
						//setTimeout(function () {
//							$('#success').hide();
//							login.hide();
//							$('form[name=login]').get(0).reset();
//							unlock(screen);
							window.location.reload();	//重载页面

						//}, 1500);
					}
					setTimeout(function () {
						_this.disabled = false;
						$(_this).css('backgroundPosition', 'left');
					}, 1500);
					
				},
				async : true
			});
		} else {
			$('#login .info').html('登录失败：用户名或密码不合法！');
		}
	});	
	
	//文本框初始化
	$('textarea[name=posttext]').focus(function(){
		$(this).val('');
	}).blur(function(){
		if($(this).val()=='') $(this).val('知识改变人生...');
	});
	
	//问题框初始化
	$('form[name=postqus]').get(0).reset();
	$('#postqus .info').html('');
	//设置问题框居中
	$(window).resize(function () {
		if($('#postqus').css('display')=='block'){
			center($('#postqus'));
		}
	});
	//问题框关闭
	$('#postqus .close').click(function(){
		$('.type span').removeClass('select');
		$('.type span').eq(0).addClass('select');
		$('#postqus .info').html('');
		$('#postqus').hide();
		unlock(screen);
		$('form[name=postqus]').get(0).reset();
	});
	//发布
	$('.type span').click(function(){	
		$('.type span').removeClass('select');
		$(this).addClass('select');
		
		//发布问题
		if($(this).html()=='问 题'){
			$('#postqus').show();
			center($('#postqus'));
			lock(screen);
		}
				
	});
	//问题发布
	$('input[name=sub]').click(function(){
		if ($.trim($('input[name=title]').val()).length <= 0 || $.trim($('textarea[name=content]').val()).length <= 0) {
			$('#postqus .info').html('发表失败：标题或内容不得为空！');
		}else{
			$('#postqus .info').html('');
			var _this = this;
			$('#loading').show();
			center($('#loading'));
			$('#loading p').html('正在发布问题...');
			_this.disabled = true;
			$(_this).css('backgroundPosition', 'right');
			$.ajax({
				type : 'post',
				url : ROOT+'/Public/post1',
				data : $('form[name=postqus]').serialize(),
				success : function (text) {
					if(text==1){
						$('#loading').hide();
						_this.disabled = false;
						$(_this).css('backgroundPosition', 'left');
						$('#error').show();
						center($('#error'));
						$('#error p').html('请先登录！');
						setTimeout(function () {
							$('#error').hide();
						}, 1500);
					}else if(text==2){
						$('#loading').hide();
						$('#success').show();
						center($('#success'));
						$('#success p').html('问题发表成功...');
						setTimeout(function () {
							$('#success').hide();
							$('#postqus').hide();
							unlock(screen);
							$('form[name=postqus]').get(0).reset();
						}, 1500);
					}else if(text==3){
						$('#loading').hide();
						$('#error').show();
						center($('#error'));
						$('#error p').html('问题发表失败！');
						setTimeout(function () {
							$('#error').hide();
						}, 1500);
					}
					setTimeout(function () {
						_this.disabled = false;
						$(_this).css('backgroundPosition', 'left');
					}, 1500);
					
				},
				async:true
			});
		}
	});
	
	//发布状态
	$('.post .send').click(function(){

		var text=$('textarea[name=posttext]').val();
		if(text==''||text=='知识改变人生...'){
			return false;
		}
		
		var typenum=$('.type span').length;
		var type;
		for(var i=0;i<typenum;i++){
			if($('.type span').eq(i).hasClass('select')){
				type=i;
			}
		}
		
		//0表示发布状态
		if(type==0){
			$.ajax({
				type:'post',
				url:ROOT+'/Public/post0',
				data:$('form[name=post]').serialize(),
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
						$('#success p').html('状态发表成功...');
						$('textarea[name=posttext]').val('知识改变人生...');
						setTimeout(function () {
							$('#success').hide();
						}, 1500);
					}else if(text==3){
						$('#error').show();
						center($('#error'));
						$('#error p').html('状态发布失败，请重新发布！');
						setTimeout(function () {
							$('#error').hide();
						}, 1500);
					}
				},
				async:true,
			});
		}
		
		return false;
	});
	
	//发布日志
	$('#top .post .type span').eq(3).click(function(){
		//跳转到写日志的页面
		window.location.href=ROOT+'/Diary/write';
	});
	
});

//设置物体居中
function center(obj){
	var top=($(window).height()-obj.height())/2+getScroll().top;
	var left=($(window).width()-obj.width())/2+getScroll().left;
	obj.css('top',top).css('left',left);
}

//跨浏览器获取滚动条位置
function getScroll() {
	return {
		top : document.documentElement.scrollTop || document.body.scrollTop,
		left : document.documentElement.scrollLeft || document.body.scrollLeft
	}
}

//锁屏
function lock(screen){
	var h=$(window).height()+getScroll().top;
	var w=$(window).width()+getScroll().left;
	screen.width(w).height(h).animate({
		opacity:0.4,
	});
}
//解屏
function unlock(screen){
	screen.animate({opacity:0,width:0,height:0});
}

//用户验证函数
function check_user() {
	var flag = true;
	var value=$.trim($('input[name=user]').eq(0).val());
	var value_length=value.length;
	if (value_length<2||value_length>20){
		$('#reg .error_user').html('输入不合法，请重新输入！');
		return false;
	} else {
		$('#reg .loading').show();
		$('#reg .info_user').hide();
		$.ajax({
			type : 'post',
			url : ROOT+'/Check/is_user',
			data : {user:value},
			success : function (text) {
				if (text == 1) {
					$('#reg .error_user').html('用户名被占用！');
					flag = false;
				} else {
					flag = true;
				}
				
				$('#reg .loading').hide();
			},
			async : false
		});
	}
	return flag;
}
//密码验证函数
function check_pass() {
	var value = $.trim($('input[name=pass]').eq(0).val());
	var value_length = value.length;
	var code_length = 0;
	
	//第一个必须条件的验证6-20位之间
	if (value_length >= 6 && value_length <= 20) {
		$('#reg .info_pass .q1').html('●').css('color', 'green');
	} else {
		$('#reg .info_pass .q1').html('○').css('color', '#666');
	}
	
	//第二个必须条件的验证，字母或数字或非空字符，任意一个即可
	if (value_length > 0 && !/\s/.test(value)) {
		$('#reg .info_pass .q2').html('●').css('color', 'green');
	} else {
		$('#reg .info_pass .q2').html('○').css('color', '#666');
	}
	
	//第三个必须条件的验证，大写字母，小写字母，数字，非空字符 任意两种混拼即可
	if (/[\d]/.test(value)) {
		code_length++;
	}
	
	if (/[a-z]/.test(value)) {
		code_length++;
	}
	
	if (/[A-Z]/.test(value)) {
		code_length++;
	}
	
	if (/[^\w]/.test(value)) {
		code_length++;
	}
	
	if (code_length >= 2) {
		$('#reg .info_pass .q3').html('●').css('color', 'green');
	} else {
		$('#reg .info_pass .q3').html('○').css('color', '#666');
	}
	
	//安全级别
	if (value_length >= 10 && code_length >= 3) {
		$('#reg .info_pass .s1').css('color', 'green');
		$('#reg .info_pass .s2').css('color', 'green');
		$('#reg .info_pass .s3').css('color', 'green');
		$('#reg .info_pass .s4').html('高').css('color', 'green');
	} else if (value_length >= 8 && code_length >= 2) {
		$('#reg .info_pass .s1').css('color', '#f60');
		$('#reg .info_pass .s2').css('color', '#f60');
		$('#reg .info_pass .s3').css('color', '#ccc');
		$('#reg .info_pass .s4').html('中').css('color', '#f60');
	} else if (value_length >= 1) {
		$('#reg .info_pass .s1').css('color', 'maroon');
		$('#reg .info_pass .s2').css('color', '#ccc');
		$('#reg .info_pass .s3').css('color', '#ccc');
		$('#reg .info_pass .s4').html('低').css('color', 'maroon');
	} else {
		$('#reg .info_pass .s1').css('color', '#ccc');
		$('#reg .info_pass .s2').css('color', '#ccc');
		$('#reg .info_pass .s3').css('color', '#ccc');
		$('#reg .info_pass .s4').html(' ');
	}	
	
	if (value_length >= 6 && value_length <= 20 && !/\s/.test(value) && code_length >= 2) {
		return true;
	} else {
		return false;
	}
}
//密码确认验证函数
function check_notpass() {
	if ($.trim($('input[name=notpass]').val()) == $.trim($('input[name=pass]').eq(0).val())) return true;
}

//某一个值是否存在某一个数组中
function inArray(array, value) {
	for (var i in array) {
		if (array[i] === value) return true;
	}
	return false;
}