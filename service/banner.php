<?php
/**
 * banner区资源列表获取接口
 * 
 * $type : 资源类型
 * 
 */
	
require_once 'tasks/CoolShow/CoolShowSearch.class.php';

$nCoolType 	= (int)(isset($_GET['mtype'])?$_GET['mtype']:4);  
$bAlbum    	= (int)(isset($_GET['album'])?$_GET['album']:0);
$nNum 		= (int)(isset($_GET['reqnum'])?$_GET['reqnum']:20);
$nPage 		= (int)(isset($_GET['page'])?$_GET['page']:0);

$nStart = $nPage *  $nNum;
$coolshow = new CoolShowSearch();
$json_result = $coolshow->getBannerList($nCoolType, $bAlbum, $nStart, $nNum);

echo $json_result;
 
require_once 'tasks/Records/RecordTask.class.php';
 
$rt = new RecordTask();
$rt->saveBanner($nCoolType);
