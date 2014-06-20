<?php
namespace Home\Controller;
use Think\Controller;
class CheckController extends Controller {
    public function index(){
//     	$model=M('User');
//     	$data=$model->field('id,user,pass')->limit(1)->select();
//     	var_dump($data);
		print_r($_COOKIE['user']);
    }
    
    //ajax验证用户
    public function is_user(){
    	$model=M('User');
    	$user=I('post.user','','addslashes,htmlspecialchars');
    	$map['user']=$user;
    	$count=$model->where($map)->limit(1)->count();
    	if($count){
    		//1表示用户被占用
    		$this->ajaxReturn('1');
    	}
    	
    }
    //ajax验证登陆
    public function is_login(){
    	$model=M('User');
    	$user=I('post.user','','addslashes,htmlspecialchars');
    	$pass=sha1(I('post.pass','',false));
    	$map['user']=$user;
    	$map['pass']=$pass;
    	$data=$model->where($map)->field('id,user,pass')->limit(1)->select();
    	if(!count($data)){
    		//1表示登陆失败
    		$this->ajaxReturn('1');
    	}else{
    		//登陆成功
    		cookie('user',stripslashes($user));
    		cookie('uid',$data[0]['id']);
    	}
    	
    }
}