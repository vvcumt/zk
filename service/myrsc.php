<?php
/**
 * 根据资源类型和ID获取单个资源的协议
 * 
 * $type : 资源类型
 * $id   : 资源ID
 */
require_once 'lib/WriteLog.lib.php';

try{
	$nCoolType = isset($_GET['type'])?$_GET['type']:0;  //cooltype:主题、壁纸、铃声、字体等分类
	$strUid     = isset($_GET['uid'])?$_GET['uid']:'';
	$nPage     = isset($_GET['page'])?$_GET['page']:0;
	$nNum     = isset($_GET['num'])?$_GET['num']:0;
	
	$nStart = $nPage * $nNum;
	
	require_once 'tasks/Exorder/ExorderRecordDb.class.php';
	$erDb = new ExorderRecordDb();
	
	$rows = $erDb->getChargeRecord($strUid, $nCoolType, $nStart, $nNum);
	if($rows === false){
		Log::write('myrsc getChargeRecord() failed', 'log');
		echo get_rsp_result(false, 'get charge record failed');
		exit();
	}
	
	require_once 'tasks/protocol/MyResProtocol.php';
	
	$arrProtocol = array();
	foreach ($rows as $row){
		$myRes = new MyResProtocol();
		$myRes->setProtocol($row);
		array_push($arrProtocol, $myRes);
	}

	$arrResult = array('result'=>true,
						'list'=>$arrProtocol);
	
	echo json_encode($arrResult); 

}catch(Exception $e){
	Log::write('myrsc exception', 'log');
	echo get_rsp_result(false, 'myrsc exception');
}