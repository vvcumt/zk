<?php
/**
 * 获取当前资源专辑
 *
 *兼容了安卓壁纸的资源
 */

require_once 'lib/WriteLog.lib.php';
require_once 'configs/config.php';

$nCoolType = isset($_GET['mtype'])?$_GET['mtype']:0;  //cooltype:主题、壁纸、铃声、专题等分类
$strId     = isset($_GET['id'])?$_GET['id']:'';
$bAlbum    = isset($_GET['album'])?$_GET['album']:0;
$nPage     = isset($_GET['page'])?$_GET['page']:0;
$nNum      = isset($_GET['num'])?$_GET['num']:100;
if (empty($strId) || strlen($strId) > 32){
	Log::write('strId length is wrong', 'log');
	exit();
}

$nStart = $nPage * $nNum;

$nChannel = $bAlbum?REQUEST_CHANNEL_ALBUMS:REQUEST_CHANNEL_BANNER;

require_once 'tasks/CoolShow/CoolShowSearch.class.php';
$rsc = new CoolShowSearch();
$result = $rsc->getNewBanner($nCoolType, $strId, $nChannel);


echo $result;

require_once 'tasks/Records/RecordTask.class.php';
$rt = new RecordTask();
$rt->saveAlbums($nCoolType);

