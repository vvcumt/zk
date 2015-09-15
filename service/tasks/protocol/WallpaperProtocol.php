<?php

require_once ('configs/config.php');
require_once 'tasks/statis/Product.class.php';

class WallpaperProtocol{
	
	private $_vercode;

	public $id;					//ID
	public $cpid;
	public $size;				//文件大小
	public $wpurl;				//壁纸URI
	public $wpmurl;				//壁纸中视图URI
	public $wpsurl;				//壁纸小视图URI;
	public $dltimes;			//下载次数
	public $author;				//作者
	public $channel;			//下载渠道
	
	function __construct(){
		$this->_vercode				= 0;
		$this->id					= 0;
		$this->cpid					= '';
		$this->size					= 0;
		$this->wpurl				= '';
		$this->wpmurl				= '';
		$this->wpsurl				= '';
		$this->dltimes				= 0;
		$this->author				= '';	
		$this->channel			    = 0;
	}
	
	public function setVercode($vercode)
	{
		$this->_vercode	= $vercode;
	}
	
	function setWallpaperUrl($url, $midUrl, $smallUrl)
	{
		$this->wpurl 		= $url;
		$this->wpmurl 		= $midUrl;
		$this->wpsurl 		= $smallUrl;
	}	
	/**
	 * 根据数据库设置主题参数
	 * @param unknown_type $row
	 */
	function setWallpaper($row, $channel = 0){
		global $g_arr_host_config;
		$this->id 				= isset($row['cpid'])?$row['cpid']:'';
		$this->cpid 			= isset($row['cpid'])?$row['cpid']:'';
		$this->size 			= (int)$row['size'];
		
		$this->wpurl 			= $g_arr_host['host'].$row['url'];
		$this->wpmurl 			= $g_arr_host['host'].$row['mid_url'];
		$this->wpsurl 			= $g_arr_host_config['cdnhost'].$row['small_url'];
		
// 		$this->width			= $row['width'];
// 		$this->height			= $row['height'];
		$this->dltimes			= (int)isset($row['download_times'])?$row['download_times']:1001;
		$this->download_times	+= rand(1000, 10000);
		$this->author			=   isset($row['author'])?$row['author']:'';
		$this->channel			= $channel;			//下载渠道
	}
	
	public function setProtocol($row, $channel = 0)
	{
		global $g_arr_host_config;
		$this->id 				= isset($row['cpid'])?$row['cpid']:'';
		$this->cpid 			= isset($row['cpid'])?$row['cpid']:'';
		$this->size 			= (int)$row['size'];
		
		$this->wpurl 			= $g_arr_host['host'].$row['url'];
		$this->wpmurl 			= $g_arr_host['host'].$row['mid_url'];
		$this->wpsurl 			= $g_arr_host_config['cdnhost'].$row['small_url'];
		
// 		$this->width			= $row['width'];
// 		$this->height			= $row['height'];
		$this->dltimes			= (int)isset($row['download_times'])?$row['download_times']:1001;
		$this->dltimes			+= rand(1000, 10000);
		$this->author			=   isset($row['author'])?$row['author']:'';
		$this->channel			= $channel;			//下载渠道
	}
	
	public function setCpid($strCpid)
	{
		$this->cpid = $strCpid;
	}
	
	public function setWidgetUrl($url)
	{
		global $g_arr_host;
		$this->wp_widget_url = $url;//$g_arr_host['host'].$url;
	}
	
	function setWallpaperRatio($width, $height){
// 		$this->width			=   $width;
// 		$this->height			= 	$height;
	}
}