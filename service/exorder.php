<?php
/**
 * 实现订单号的请求
 *如果已付过费，则反馈已付费信息
 * id:
 * type: themes,font,ring,scence
 *  
 **/
session_start();
require_once 'tasks/Exorder/Exorder.class.php';
require_once 'tasks/Exorder/ExorderDb.class.php';
require_once 'tasks/Exorder/ExorderRecordDb.class.php';
require_once 'lib/WriteLog.lib.php';
require_once 'public/public.php';
require_once 'configs/config.php';

$nCoolType 	= isset($_GET['type'])?$_GET['type']:0;
$strId 		= isset($_GET['id'])?$_GET['id']:'';
$strCpid 	= isset($_GET['cpid'])?$_GET['cpid']:'';
if(empty($strId)){
	echo get_rsp_result(false, 'id is empty');
	exit;
}

$strProduct = '';
$strMeid	= '';
$strImei	= '';
$strImsi	= '';
$strUid		= '';
$strNet		= '';
$kernel		= isset($_GET['kernel'])?$_GET['kernel']:0;
$strVercode	= isset($_GET['vercode'])?$_GET['vercode']:0;

$json_param = isset($_POST['statis'])?$_POST['statis']:'';
if(!empty($json_param)){
	$json_param = stripslashes($json_param);
	$arr_param = json_decode($json_param, true);

	$strProduct = isset($arr_param['product'])?$arr_param['product']:'';
	$strMeid	 = isset($arr_param['meid'])?$arr_param['meid']:'';
	$strImei	 = isset($arr_param['imei'])?$arr_param['imei']:'';
	$strImsi	 = isset($arr_param['imsi'])?$arr_param['imsi']:'';
	$strUid	 	 = isset($arr_param['uid'])?$arr_param['uid']:'';
	$strNet		 = isset($arr_param['net'])?$arr_param['net']:'';
}

$erDb = new ExorderRecordDb();
$bResult = $erDb->checkMobileCharged($strProduct, $nCoolType, $strId, $strCpid, $strMeid, $strImsi, $strUid);
if($bResult){
	$reuslt = array('result'=>true,
					'exorder'=>'',
					'charged'=>true);
	echo json_encode($reuslt);
	exit();
}

$exorderDb = new ExorderDb();
$strExorder = $exorderDb->createExorder($nCoolType);
if(!$strExorder){
	echo get_rsp_result(false, 'create exorder failed');
	exit();
}
$reuslt = array('result'=>true,
				'exorder'=>$strExorder,
				'charged'=>false);
echo json_encode($reuslt);


$bQuery		= isset($_GET['query'])?$_GET['query']:0;#0表示拉取订单号和收费信息，1表示查询收费信息
if($bQuery){
	exit();
}

require_once 'tasks/CoolShow/CoolShowSearch.class.php';
require_once 'tasks/Records/RecordTask.class.php';
$coolshow = new CoolShowSearch();
$arrRsc = $coolshow->getRsc($nCoolType, $strId);
$arrRsc = $arrRsc['result'];

$cpid 	= '';
$name   = '';
$userid = '';
$author = '';
$type 	= '';
$appid  = '';
$waresid= '';
$money 	= '';
foreach ($arrRsc as $rsc){
	if ($nCoolType == COOLXIU_TYPE_SCENE){
		$cpid 	= $rsc->sceneId;
		$name 	= $rsc->sceneZName;
		$author = $rsc->authorName;
	}else{
		$cpid 	= $rsc->cpid;
		$name 	= $rsc->name;
		$author = $rsc->author;
	}
	$userid = $rsc->getUserid();
	$type 	= $rsc->type;
	$appid  = $rsc->productId;
	$waresid= $rsc->waresId;
	$money 	= $rsc->price;
	$ruleid = $rsc->ruleid;
	$score 	= $rsc->score;
}

$erDb->saveMobileExorder($nCoolType, $strExorder, $ruleid, $score, 
						$strId, $cpid, $name, $userid, $author, $type,
						$appid, $waresid, $money,
						$strProduct, $strMeid, $strUid, $strImsi, $strNet,
						$strVercode, $kernel);

$rf = new RecordTask();
$rf->saveOrder($nCoolType, $strId, $cpid, $ruleid, $score, 
				$name, $userid, $author, $type, 
				$appid, $waresid, $money, $strExorder);


