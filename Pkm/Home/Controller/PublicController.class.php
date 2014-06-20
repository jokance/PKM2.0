<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function index(){

    }
    //登出
    public function logout(){
    	cookie('user',null);
		$pre=$_SERVER['HTTP_REFERER'];
		header("Location:".$pre);
    }
    
    //新增用户
    public function add(){
    	$user=D('User');
    	$data = $user->create();
    	if(!$data){
    		//验证失败
    		$this->ajaxReturn($user->getError());
    	}else{
    		//验证成功
    		$data['date'] = date('Y-m-d H:i:s');
    		$user->add($data);
    		//成功返回1
    		$this->ajaxReturn('1');
    	}
    
    }
    
    //发布状态
    public function post0(){
    	//1表示未登录,表示已登录
    	!isset($_COOKIE['user'])?$this->ajaxReturn('1'):null;
    	
    	//插入数据库
    	$state=M('State');
    	$data['text']=I('post.posttext','','addslashes,htmlspecialchars');
    	$data['date']=date('Y-m-d H:i:s');
    	$data['uid']=cookie('uid');
    	
    	if($state->add($data)){
    		//2表示数据插入成功
    		$this->ajaxReturn('2');
    	}else{
    		//3表示数据插入失败
    		$this->ajaxReturn('3');
    	}
    	
    }
    
    //发布问题
    public function post1(){
    	!isset($_COOKIE['user'])?$this->ajaxReturn('1'):null;
    	
    	$qus=M('Qus');
    	$data['title']=I('post.title','','addslashes,htmlspecialchars');
    	$data['content']=I('post.content','','addslashes,htmlspecialchars');
    	$data['tag']=I('post.tag','','addslashes,htmlspecialchars');
    	$data['date']=date('Y-m-d H:i:s');
    	$data['uid']=cookie('uid');
    	
    	if($qus->add($data)){
    		//2表示数据插入成功
    		$this->ajaxReturn('2');
    	}else{
    		//3表示数据插入失败
    		$this->ajaxReturn('3');
    	}
    }
    //发布资源
    public function post2(){
    	
    }
    //发布日志
    public function post3(){
    	
    }
    //发布回答
    public function post4(){
    	!isset($_COOKIE['user'])?$this->ajaxReturn('1'):null;
    	$ans=M('Ans');
    	$data['qusid']=I('post.qusid');
    	$data['content']=I('post.text','','addslashes,htmlspecialchars');
    	$data['date']=date('Y-m-d H:i:s');
    	$data['uid']=cookie('uid');
    	$data['user']=addslashes(cookie('user'));
    	if($ans->add($data)){
    		//2表示数据插入成功
    		$this->ajaxReturn('2');
    	}else{
    		//3表示数据插入失败
    		$this->ajaxReturn('3');
    	}
    }
   
    //ajax获取更多回答
    public function answer(){
    	if(!!$qusid=I('post.qusid')){
			$ansnum=I('post.ansnum')+1;
			
    		$ans=M('Ans');
    		$data=$ans->where(array('qusid'=>$qusid))->order('date asc')->limit($ansnum*5,5)->select();
    		if(empty($data)){
				//问题已经没有了
    			$this->ajaxReturn('1');
    		}else {
    			foreach ($data as $value){
	    			echo '<div class="detail">';
	    			echo '<input type="hidden" name="uid" value="'.$value['uid'].'"/>';
	    			echo '<h2><span class="nickname"><a href="javascript:void(0);">'.stripslashes($value['user']).'</a></span><span class="date">'.$value['date'].'</span></h2>';
	    			echo '<div class="text">'.stripslashes($value['content']).'</div>';
	    			echo '<div class="comment"><a href="javascript:void(0);">赞('.$value['zan'].')</a><a href="javascript:void(0);">踩('.$value['cai'].')</a></div>';
	    			echo '</div>';
    			}
    		}
    		
    	}
    }
    
    /*
    //ajax获取更多问题
    public function ask(){
    	if(!!I('post.act')){
    		$asknum=I('post.asknum')+1;
    			
    		$qus=M('Qus');
    		$data=$qus->order('date desc')->limit($asknum*10,10)->select();
    		if(empty($data)){
    			//问题已经没有了
    			$this->ajaxReturn('1');
    		}else {
    			foreach ($data as $value){
    				echo '<div class="question">';
    				echo '<div class="title">■<a target="_blank" href="'.U('Ask/answer',"id=$value[id]").'">'.$value["title"].'</a></div>';
    				echo '<div class="desc">'.mb_substr(stripslashes($value["content"]),0,100,"UTF-8").'</div>';
    				
    				$tag=preg_split('/,|，/',trim($value['tag']));
    					
    					
    				echo '<div class="tag"><span>标签：</span>';
    				foreach ($tag as $tagval){
    					echo '<a href="###">'.trim($tagval).'</a>';
    				}

    				echo '<span class="comment"><a href="###" onclick="return comment(this)">我要回答</a></span></div><div class="postans">';
    				echo '<form name="postans"><input type="hidden" name="qusid" value="'.$value["id"].'"/>';
    				echo '<textarea name="text"></textarea><span style="display:inline-block;padding:5px 0 0 0;color:#999;">请在上面添加答案</span><input type="button" value="提交" class="send" onclick="return sendans(this)"/></form></div></div>';
    			}
    		}
    
    	}
    }
    */
    
    
    
    
    
    
    
}







