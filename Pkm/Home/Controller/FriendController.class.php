<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\Recommend;

class FriendController extends Controller {
	//friend主页，show.html
    public function index(){
    	//标题
    	$this->assign('title','好友');
    	if(!isset($_COOKIE['user'])){
    		//flag用于表示用户的登陆情况，0表示未登陆，1表示登陆
    		$this->assign('flag','0');
    		$this->display('show');
    	}else{
    		$user=D('User');
    		$this->assign('flag','1');
    		$uid=cookie('uid');
    		$uname=addslashes(cookie('user'));
    		//获取好友
    		$friend=M('Friend');
    		$map['touser']=$uname;
    		$map['fromuser']=$uname;
    		$map['_logic']='or';
    		$allFriends=$friend->where($map)->field('fromuser,touser')->select();
    		$friendList=array();//好友表
    		foreach($allFriends as $value){
    			if($value['fromuser']==$uname){
    				$friendList[]=$value['touser'];
    			}elseif($value['touser']==$uname){
    				$friendList[]=$value['fromuser'];
    			}
    		}
    		$friendList=implode(',', $friendList);//好友列表字串
    		//根据好友名称查找好友其他信息
    		$friendData=$user->relation(true)->where(array('user'=>array('in',"$friendList")))->field('id,user,email,ps')->select();
    		$this->assign('friendData',$friendData);
    		$friendId=array();//好友的ID，用于推荐部分，即已经是好友了就不要给用户推荐
    		foreach($friendData as $value){
    			$friendId[]=$value['id'];
    		}
    		
			//推荐算法部分
	    	$ans=M('Ans');
	    	//获取元素数据记录集
	    	$data=$ans->distinct(true)->field('qusid,uid')->select();
	    	$rec=new Recommend($data);//实例化推荐类			
	    	$W=$rec->userSimilarity();//用户相似矩阵
	    	$usim=$W["$uid"];//该登陆用户和其他用户的相似性，数组
	    	arsort($usim);//依据相似性大小从大到小排列    
	    	$sim_uid=array_keys($usim);//返回用户的id，数组
	    	$sim_uid=array_diff($sim_uid, $friendId);//计算差集，确保相似用户中没有好友
	    	$sim_uid=array_slice($sim_uid, 0,5,true);//取出前5个最相似的用户
	    	$sim_uid=implode(',', $sim_uid);//返回用户的id串，用,分割
	    	//从用户表中取出相似用户的信息	    	
	    	$data=$user->where(array('id'=>array('in',"$sim_uid")))->field('id,user,ps')->select();
	    	$this->assign('RecUser',$data);
	    	//print_r($rec->recommend(18));//推荐问题
	    	
	    	$this->display('show');
    	}
    }
    
    //添加好友
    public function addf(){
    	!isset($_COOKIE['user'])?$this->ajaxReturn('1'):null;
     	$data['touser']=I('post.touser','stripslashes');   	
     	$data['fromuser']=stripslashes(cookie('user'));  	
    	$data['date']=date('Y-m-d H:i:s');
     	$friend=M('Friend');
     	$map['fromuser']=$data['fromuser'];
     	$map['touser']=$data['touser'];
     	$map['_logic']='or';
     	$map['fromuser']=$data['touser'];
     	$map['touser']=$data['fromuser'];
     	
     	if($friend->where($map)->select()){
     		//4表示两人已经是好友
     		$this->ajaxReturn('4');
     		exit();
     	}
     	if($friend->add($data)){
    		//好友添加成功
    		$this->ajaxReturn('2');
    	}else{
    		//好友添加失败
    		$this->ajaxReturn('3');
    	}
    }
}












