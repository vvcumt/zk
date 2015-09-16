<?php

try{
	require_once 'lib/WriteLog.lib.php';
	require_once 'public/public.php';
	require_once 'configs/config.php';
		
	$id = isset($_GET['id'])?$_GET['id']:'';
	$cpid = isset($_GET['cpid'])?$_GET['cpid']:'';
	if(empty($id)){
		Log::write('thdownload:ID is empty', 'log');
		exit;
	}
	$nCoolType = isset($_GET['mtype'])?$_GET['mtype']:0;
	
	$strProduct = '';
	$strImsi    = '';
	$strMeid    = '';
	$protocolCode = 0;
	$strUid 	= '';
	if(isset($_POST['statis'])){
		$json_param = isset($_POST['statis'])?$_POST['statis']:'';
		
		$json_param = stripslashes($json_param);
		$arr_param = json_decode($json_param, true);
		
		$strProduct = isset($arr_param['product'])?$arr_param['product']:'';
		$strMeid = isset($arr_param['meid'])?$arr_param['meid']:'';
		$strUid = isset($arr_param['uid'])?$arr_param['uid']:'';
		$procode = (int)(isset($arr_param['procode'])?$arr_param['procode']:0);
	}
	
	require_once("tasks/CoolShow/CoolShowSearch.class.php");
	//下面两个数据库操作可以合并优化
	$coolshow = new CoolShowSearch();
	$bIsCharge = $coolshow->checkIscharge(COOLXIU_TYPE_THEMES, $id);
	if($bIsCharge){
		require_once 'tasks/Exorder/ExorderRecordDb.class.php';	
		$erDb = new ExorderRecordDb();
		$bResult = $erDb->checkMobileCharged($strProduct, $nCoolType, $id, $cpid, $strMeid, $strImsi, $strUid);
		if(!$bResult){
			$result = get_rsp_result(false, 'the resource is not paid');
			exit($result);
		}
	}
		
	$url = $coolshow->getUrl($nCoolType, $id);
	if($url === false){
		Log::write('CoolShowSearch::getUrl(COOLXIU_TYPE_THEMES) id:'.$id, 'log');
		exit;
	}
	
	url_skip_download($url);
	
	
}catch(Exception $e){
	Log::write('thdownload:: exception error:'.$e->getMessage(), 'log');
	exit;
}