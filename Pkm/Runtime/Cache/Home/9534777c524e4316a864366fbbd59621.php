<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PKM门户--<?php echo ($title); ?></title>
<link rel="stylesheet" type="text/css" href="/PKM2.0/Public/css/basic.css" /><link rel="stylesheet" type="text/css" href="/PKM2.0/Public/css/answer.css" />
<script type="text/javascript" src="/PKM2.0/Public/js/jquery_min.js"></script><script type="text/javascript" src="/PKM2.0/Public/js/basic.js"></script><script type="text/javascript" src="/PKM2.0/Public/js/ask_answer.js"></script>
</head>
<body>	
<div id="main">
	<!-- 引入公共模板 -->
	<div id="left">
	<h2>图标</h2>
	<ul>
		<li class="diary"><a href="<?php echo U('Diary/index');?>">日志</a></li>
		<li class="friend"><a href="<?php echo U('Friend/index');?>">好友</a></li>
		<li class="ask"><a href="<?php echo U('Ask/index');?>">问答</a></li>
		<li class="link"><a href="###">知识关系链</a></li>
		<li class="group"><a href="<?php echo U('Group/index');?>">群组</a></li>
		<li class="inform"><a href="###">通知</a></li>
	</ul>
</div>
<script type="text/javascript">
    var PUBLIC= "/PKM2.0/Public";
    var APP = "/PKM2.0/index.php";
    var ROOT = "/PKM2.0";
</script><div id="top">
	<div class="search">
		<input type="text" name="search" class="text" placeholder="搜索"/>
	</div>
	
	<div class="log-reg">
		<?php if(empty($_COOKIE['user'])): ?><a class="login" href="javascript:void(0);">登陆</a>
			<a class="register" href="javascript:void(0);">注册</a>
		<?php else: ?>
			<a class="user" href="javascript:void(0);"><?php echo (cookie('user')); ?></a> <a href="<?php echo U("Public/logout");?>">退出</a><?php endif; ?>
		
		
	</div>

	<div class="post"> 
		<form name="post">
			<div class="type"><span class="select">状态</span><span>问 题</span><span>资 源</span><span>日 志</span></div>
			<textarea name="posttext">知识改变人生...</textarea>
			<button class="upload"></button>
			<button class="send">发表</button>
		</form>
	</div>
</div>

<div id="reg">
	<h2><img src="/PKM2.0/Public/images/close.png" alt="" class="close" />会员注册</h2>
	<form name="reg">
	<dl>
		<dd>昵　　称： <input type="text" name="user" class="text" />
			<span class="info info_user">请输入用户名，2~20位，由字母、数字和下划线组成！</span>
			<span class="error error_user">输入不合法，请重新输入！</span>
			<span class="succ succ_user">可用</span>
			<span class="loading">正在检测用户名...</span>
		</dd>
		<dd>密　　码： <input type="password" name="pass" class="text" />
			<span class="info info_pass">
				<p>安全级别：<strong class="s s1">■</strong><strong class="s s2">■</strong><strong class="s s3">■</strong> <strong class="s s4" style="font-weight:normal;"></strong></p>
				<p><strong class="q1" style="font-weight:normal;">○</strong> 6-20 个字符</p>
				<p><strong class="q2" style="font-weight:normal;">○</strong> 只能包含大小写字母、数字和非空格字符</p>
				<p><strong class="q3" style="font-weight:normal;">○</strong> 大、小写字母、数字、非空字符，2种以上</p>
			</span>
			<span class="error error_pass">输入不合法，请重新输入！</span>
			<span class="succ succ_pass">可用</span>
		</dd>
		<dd>密码确认： <input type="password" name="notpass" class="text" />
			<span class="info info_notpass">请再一次输入密码！</span>
			<span class="error error_notpass">密码不一致，请重新输入！</span>
			<span class="succ succ_notpass">可用</span>
		</dd>
		<dd><span style="vertical-align:-2px">提　　问：</span> <select name="ques">
									<option value="0">- - - - 请选择 - - - -</option>
									<option value="1">- - 您最喜欢吃的菜</option>
									<option value="2">- - 您的狗狗的名字</option>
									<option value="3">- - 您的出生地</option>
									<option value="4">- - 您最喜欢的明星</option>
								  </select>
			<span class="error error_ques">尚未选择提问，请选择！</span>				  
		</dd>
		<dd>回　　答： <input type="text" name="ans" class="text" />
			<span class="info info_ans">请输入回答，2~32位！</span>
			<span class="error error_ans">回答不合法，请重新输入！</span>
			<span class="succ succ_ans">可用</span>
		</dd>
		<dd>电子邮件： <input type="text" name="email" class="text" autocomplete="off" />
			<span class="info info_email">请输入电子邮件！</span>
			<span class="error error_email">邮件不合法，请重新输入！</span>
			<span class="succ succ_email">可用</span>
			<ul class="all_email">
				<li><span></span>@qq.com</li>				
				<li><span></span>@163.com</li>
				<li><span></span>@sohu.com</li>
				<li><span></span>@sina.com.cn</li>
				<li><span></span>@gmail.com</li>
			</ul>
		</dd>
		<dd class="birthday"><span style="vertical-align:-2px">生　　日：</span> <select name="year">
									<option value="0">- 年 -</option>
								  </select> -
								  <select name="month">
									<option value="0">- 月 -</option>
								  </select> -
								  <select name="day">
									<option value="0">- 日 -</option>
								  </select>
			<span class="error error_birthday">尚未全部选择，请选择！</span>	  
		</dd>
		<dd style="height:105px;"><span style="vertical-align:85px">备　　注：</span> <textarea name="ps"></textarea></dd>			
		<dd style="display:block;" class="ps">还可以输入<strong class="num">200</strong>字</dd>	
		<dd style="display:none;" class="ps">已超过<strong class="num"></strong>字，<span class="clear">清尾</span></dd>		
		<dd style="padding:0 0 0 80px;"><input type="button" name="sub" class="submit" /></dd>
	</dl>
	</form>
</div>

<div id="login">
	<h2><img src="/PKM2.0/Public/images/close.png" alt="" class="close" />网站登录</h2>
	<form name="login">
	<div class="info"></div>
	<div class="user">昵 称：<input type="text" name="user" class="text" /></div>
	<div class="pass">密 码：<input type="password" name="pass" class="text" /></div>
	<div class="button"><input type="button" name="sub" class="submit" value="" /></div>
	<div class="other">注册新用户 | 忘记密码？</div>
	</form>
</div>

<div id="postqus">
	<h2><img src="/PKM2.0/Public/images/close.png" alt="" class="close" />发布问题</h2>
	<div class="info"></div>
	<form name="postqus">
	<dl>
		<dd>标　　题： <input type="text" name="title" class="title" /> (*不可为空)</dd>
		<dd><span style="vertical-align:55px">描　　述：</span> <textarea name="content" class="content"></textarea> <span style="vertical-align:45px">(*不可为空)</span></dd>	
		<dd>标　　签： <input type="text" name="tag" class="title" /> (使用逗号隔开)</dd>			
		<dd style="padding:10px 0 0 86px;"><input type="button" name="sub" class="submit" /></dd>
	</dl>
	</form>
</div>

<div id="loading">
	<p>加载中</p>
</div>

<div id="success">
	<p>成功</p>
</div>
<div id="error">
	<p>失败</p>
</div>
<!-- 锁屏 -->
<div id="screen"></div>

	<a name="gotop" id="gotop"></a>
	<div id="foot">
		<div class="nav">
				这里添加导航
		</div>
		<div class="bar">
			<div class="back"><a href="<?php echo ($_SERVER['HTTP_REFERER']); ?>">返回上一级</a></div>
		</div>
	
		<div class="question">
			<div class="title"><?php echo (stripslashes($oneQus["title"])); ?> <a href="###"><?php echo (stripslashes($user["user"])); ?></a></div>
			<div class="desc">描述：<?php echo (stripslashes($oneQus["content"])); ?></div>
			<?php $tag=preg_split('/,|，/',trim($oneQus['tag'])); ?>
			
			
			<div class="tag"><span>标签：</span>
				<?php if(is_array($tag)): $i = 0; $__LIST__ = $tag;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tagval): $mod = ($i % 2 );++$i;?><a href="###"><?php echo (stripslashes(trim($tagval))); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
			
			
				<span class="comment"><a href="javascript:void(0);">我要回答</a></span>
			</div>
			<div class="postans">
				<form name="postans">
					<input type="hidden" name='qusid' value="<?php echo ($oneQus["id"]); ?>"/>
					<textarea name="text">请在这里添加答案...</textarea>
					<input type="button" value="提交" class="send"/>
				</form>
			</div>
		</div>
		<div class="answer">
			<?php if(is_array($oneQus["ans"])): $i = 0; $__LIST__ = $oneQus["ans"];if( count($__LIST__)==0 ) : echo "暂时没有回答..." ;else: foreach($__LIST__ as $key=>$ans): $mod = ($i % 2 );++$i;?><div class="detail">
				<input type="hidden" name="uid" value="<?php echo ($ans["uid"]); ?>"/>
				<h2><span class="nickname"><a href="javascript:void(0);"><?php echo ($ans["user"]); ?></a></span><span class="date"><?php echo ($ans["date"]); ?></span></h2>
				<div class="text"><?php echo (stripslashes($ans["content"])); ?></div>
				<div class="comment"><a href="javascript:void(0);">赞(<?php echo ($ans["zan"]); ?>)</a><a href="javascript:void(0);">踩(<?php echo ($ans["cai"]); ?>)</a></div>
			</div><?php endforeach; endif; else: echo "暂时没有回答..." ;endif; ?>
			<div class="newans"></div>
			<input type="hidden" name="jishu" value="0"/>
			<div class="ans_more"><a href="javascript:void 0">更多回答</a></div>
		</div>
			
	</div>
</div>	
</body>
</html>