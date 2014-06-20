<?php
namespace Home\Controller;
use Think\Controller;
class GroupController extends Controller {
    public function index(){
    	$this->assign('title','群组');
    	$this->display('show');
    }
}