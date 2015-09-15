<?php
abstract class Protocol
{
	protected  $_vercode;		//当前版本号
	protected  $_nKernelCode;	//模块内核版本
	
	public $id;					//ID下载及下载统计用
	public $cpid;				//资源ID
	protected  $_userid;		//主题作者ID
	public $uid;				//主题作者ID
	public $author;				//主题作者
	
	public $dltimes;			//下载次数
	
	public $chp;				//chargpoint计费点
	public $price;				//价格(单位为分)
	public $ischarge;			//是否收费

	public $channel;			//下载渠道
	
	public $ruleid;				//消耗积分规则ID
	public $score;				//积分分值
	public $incruleid;			//积累积分规则ID
	public $incscore;			//积分分值	
	
	public function __construct(){
		$this->_vercode				= 0;
		$this->_nKernelCode			= 1;
		
		$this->cpid					= '';
		$this->uid					= '';
		
		$this->dltimes				= 0;
		
		$this->chp					= 1;
		$this->price				= 0;
		$this->ischarge				= false;
		
		$this->channel				= 0;
		
		$this->ruleid				= '';
		$this->incruleid			= '';
		$this->score				= 0;
		$this->incscore				= 0;
	}
	
	public function getUserid()
	{
		return $this->uid;
	}
	
	public function setVercode($vercode)
	{
		$this->_vercode	= $vercode;
	}

	public function setKernelCode($nKernelCode)
	{
		$this->_nKernelCode = $nKernelCode;
	}
	
	protected  function setCommonParam($row, $channel = 0)
	{
		$this->author 				= isset($row['author'])?$row['author']:'CoolUI';
		$this->uid 					= isset($row['userid'])?$row['userid']:'CoolUI';
		
		$bCharge 					= isset($row['ischarge'])?$row['ischarge']:false;
		$this->ischarge				= $bCharge?true:false;
		$this->dltimes 				=  (int)isset($row['download_times'])?$row['download_times']:0;
		if($bCharge){
			$this->dltimes 		+= ((int)($this->id)) %1000; //rand(1000, 10000);
		}else{
			$this->dltimes 		+= ((int)($this->id)) %10000; //rand(1000, 10000);
		}

		$this->chp					= (int)isset($row['chargepoint'])?$row['chargepoint']:1;
		$this->price				= (int)isset($row['price'])?$row['price']:0;
		
		$this->channel				= $channel;
		
		$this->ruleid				= isset($row['ruleid'])?$row['ruleid']:'';
		$this->incruleid				= isset($row['incruleid'])?$row['incruleid']:'';
		$this->score				= (int)(isset($row['score'])?$row['score']:0);
		$this->incscore				= (int)(isset($row['incscore'])?$row['incscore']:0);
	}
	abstract function setProtocol($row, $nChannel = 0);
}