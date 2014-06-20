<?php
namespace Home\Controller;
use Think\Controller;
class DiaryController extends Controller {
    public function index(){
    	$this->assign('title','日志');
    	$this->display('show');
    }
    
    //写日志
    public function write(){
    	$this->assign('title','写日志');
    	
    	$this->display();
    }
}