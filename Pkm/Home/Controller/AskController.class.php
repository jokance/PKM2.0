<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\Page;
class AskController extends Controller {
	//ask主页，show.html
    public function index(){
    	//标题
    	$this->assign('title','问答');
    	//问题表模型
    	$qus=M('Qus');
    	//分页
    	$total=$qus->count();
    	$page=new Page($total, 20);
    	$limit=$page->getLimit();
    	//取出问题
    	$allQus=$qus->field('id,title,content,tag')->order('date desc')->limit("$limit")->select();
    	$this->assign('allQus',$allQus);
    	$this->assign('page',$page);//分页对象
    	
    	$this->display('show');
    }
    
    //回答问题answer.html
    public function answer(){
    	//标题
    	$this->assign('title','回答');
    	//问题id
    	$qusid=I('get.id');
    	//取出id为qusid的问题
    	$qus=D('Qus');
    	$oneQus=$qus->where(array('id'=>$qusid))->limit(1)->relation(true)->select();
    	$this->assign('oneQus',$oneQus[0]);
    	//取出发表问题的用户名
    	$user=M('user');
    	$username=$user->where(array('id'=>$oneQus[0]['uid']))->field('user')->limit(1)->select();
    	$this->assign('user',$username[0]);
    	$this->display();
    }
}