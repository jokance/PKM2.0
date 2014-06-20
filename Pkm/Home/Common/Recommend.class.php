<?php
namespace Home\Common;
//推荐算法UserCF
class Recommend{
	private $train;//训练集
	private $W=array();//用户相似度,$W[u][v]表示用户u和用户v的相似度
	private $K;//和用户最接近的K个用户
	
	public function __construct($data,$K=5){
		$this->train=$this->makeTrain($data);
		$this->W=$this->userSimilarity();
		$this->K=$K;
	}
	
	//构造训练集
	public function makeTrain($data){
		//数据总数
		$total=count($data);
		//训练集
		$train=array();
		for($i=0;$i<$total;$i++){
			//去重
			$uid=$data[$i]['uid'];
			$qusid=$data[$i]['qusid'];
			$train[$i]=array($uid,$qusid);//不妥，因为一个问题可能由一个用户回答多次，要去重
			
		}
		
		return $train;
	}
	
	//计算相似度
	public function userSimilarity(){
		//建立物品列表
		$item_user=array(); //存放物品列表
		
		for($i=0;$i<count($this->train);$i++){
			$item=$this->train[$i][1];
			$user=$this->train[$i][0];
			$item_user[$item][]=$user;
		}
	
		$N=array(); //$N[u]表示用户u使用过的物品总数
		$C=array(); //C[u][v]=|N(u)∩N(u)|
		foreach($item_user as $user){
			for($i=0;$i<count($user);$i++){
				$N[$user[$i]]+=1;
				for($j=0;$j<count($user);$j++){
					if($user[$i]!=$user[$j]){
						$C[$user[$i]][$user[$j]]+=1;
					}
				}
			}
		}
	
		foreach($C as $key=>$value){
			$u=$key;    //用户u
			foreach($value as $v=>$cuv){
				$this->W[$u][$v]=$cuv/sqrt($N[$u]*$N[$v]);
			}
		}
	
		return $this->W;
	}
	
	//推荐算法
	public function recommend($user){
		$rank=array();  //用户对物品的感兴趣程度
	
		for($i=0;$i<count($this->train);$i++){
			if($this->train[$i][0]==$user){
				//用户使用过的物品集合
				$interacted_items[]=$this->train[$i][1];
			}
		}
	
		$group=$this->W[$user];   //和用户兴趣相似的其他用户
		arsort($group);
		$count=0;   //计算器
		foreach($group as $v=>$wuv){
			$count++;
			for($i=0;$i<count($this->train);$i++){
				if($this->train[$i][0]==$v&&!in_array($this->train[$i][1], $interacted_items)){
					$rank[$this->train[$i][1]]+=$wuv;
				}
			}
	
			if($count==$this->K) break;
		}
	
		return $rank;
	}
}