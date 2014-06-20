<?php
namespace Home\Model;
use Think\Model\RelationModel;

class QusModel extends RelationModel{
	protected $_link=array(
			'Ans'=>array(
					'mapping_type'=>self::HAS_MANY,
					'mapping_name'=>'ans',
					'foreign_key'=>'qusid',
					'mapping_order'=>'date ASC',
					'mapping_limit'=>'0,5'
			),
	);
}