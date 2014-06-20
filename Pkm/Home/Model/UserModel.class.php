<?php
namespace Home\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel{
	//批量验证
	//protected $patchValidate=true;
	//自动验证
	protected $_validate=array(
			array('user','require','用户名不得为空！'),
			array('user','2,20','用户名不得小于2位，不得大于20位！',0,'length'),
			array('pass','6,20','密码不得小于6位，不得大于20位',0,'length'),
			array('pass','notpass','密码和密码验证不一致！',0,'confirm'),
			array('ans','2,32','回答不得小于2位，不得大于32位！',0,'length'),
			array('email','email','邮箱格式不合法！'),
			array('ps','0,200','备注内容不得大于200位！',0,'length'),
	);

	//自动完成
	protected $_auto=array(
			array('user','addslashes',3,'function'),
			array('user','htmlspecialchars',3,'function'),
			array('pass','sha1',3,'function'),
			array('ans','addslashes',3,'function'),
			array('ans','htmlspecialchars',3,'function'),
			array('ps','addslashes',3,'function'),
			array('ps','htmlspecialchars',3,'function'),
	);
	
	//连表查询
	protected $_link=array(
			'State'=>array(
				'mapping_type'=>self::HAS_MANY,
				'mapping_name'=>'state',
				'foreign_key'=>'uid',
				'mapping_order'=>'date desc',
				'mapping_limit'=>'0,5',
				'mapping_fields'=>'text,date'
			),	
	);
}









