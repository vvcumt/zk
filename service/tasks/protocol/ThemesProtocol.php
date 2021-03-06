<?php
/**
 * 按客户端请求响应的协议格式定义的类型，方便对象生成JSON格式的响应流
 *
 * @author lijie1@yulong.com
 */
require_once 'tasks/protocol/Protocol.php';
require_once ('./configs/config.php');




class PrevProtocol{
	public $img_url;		//缩略图URI
	public function Preview(){
		$this->img_url = "";
	}
	public function getMainPrev($prev){
		global $g_arr_host_config;
		return $g_arr_host_config['cdnhost'].$prev['prev_url'];
	}
	public function setPrev($prev){
		global $g_arr_host_config;
		$this->img_url = $g_arr_host_config['cdnhost'].$prev['prev_url'];
	}
}

class ThemesProtocol extends Protocol
{
	const YL_TH_DOWNLOAD_URL = '/service/thdownload.php?id=%s&cpid=%s&type=%d&channel=%d&author=%s';

	public $name;				//主题名	public $enname;				//主题名英文
	public $size;				//主题文件大小
	public $desc;				//主题描述
	public $url;				//主题URI,绝对路径
	public $mpurl;				//主缩略图URI
	public $mcurl;				//contact主缩略图URI 判断是否为通讯录主题
	public $miurl;				//icon主缩略图URI 判断是否为图标主题
	public $mmurl;				//mms主缩略图URI 
	
	private $_index;	
	public $icontact;		//contact预览图索引	public $iicon;			//icon预览图索引	public $imms;			//mms预览图索引	
	public $c_time;				//主题创建时间
	public $pnum;				//缩略图数量	
	public $intro; 				//主题描述
	public $starlevel;			//主题星级
	public $kernel;				//内核版本			2015.4.15

	public $effect;	 			//主题特效
    public $font_style; 		//主题字体样式
    public $keyguard_style; 	//主题解锁样式
    public $prev_imgs;			//主题缩略图数组	
    public $ad;					//0:无1：网页2：文件	public $adicon;				//广告图片
	public $adurl;				//广告地址
	
	function __construct(){
		parent::__construct();
		$this->id					=	0;
		$this->author				= 	'';
		$this->name					= 	'';
		$this->size					= 	0;
		$this->desc					= 	'';
		$this->turl					= 	'';
		$this->mpurl				= 	'';
		
		$this->mcurl				= '';
		$this->miurl				= '';
		$this->mmurl				= '';
		
		$this->_index				= 0;
		$this->icontact				= 0;
		$this->iicon				= 0;
		$this->imms					= 0;
		
		$this->c_time				= 	'';
		$this->pnum					= 	0;

		$this->intro				=  '';
		$this->starlevel			=  '';
		
		$this->kernel				=  0;
		
		$this->type					= 	0;
		
		$this->effect				=   '';	 			
		$this->font_style			=   ''; 	
		$this->keyguard_style		=   ''; 	
		$this->prev_imgs 			= array();
		
		$this->ad					= 0;
		$this->adicon				= '';
		$this->adurl				= '';
	}
	
	public function setMainPrev($prev){
		global  $g_arr_host_config;
		$strUrl = isset($prev['pre_url'])?$prev['pre_url']:'';
		if (empty($strUrl)) $strUrl = $prev['prev_url'];
		$this->mpurl 	= $g_arr_host_config['cdnhost'].$strUrl;//$prev['prev_url'];
		
		$strUrl = isset($prev['pre_contact'])?$prev['pre_contact']:'';
		if (!empty($strUrl)) $this->mcurl = $g_arr_host_config['cdnhost'].$strUrl;//$prev['prev_url'];

		$strUrl = isset($prev['pre_icon'])?$prev['pre_icon']:'';
		if (!empty($strUrl)) $this->miurl = $g_arr_host_config['cdnhost'].$strUrl;//$prev['prev_url'];
		
		$strUrl = isset($prev['pre_mms'])?$prev['pre_mms']:'';
		if (!empty($strUrl)) $this->mmurl = $g_arr_host_config['cdnhost'].$strUrl;//$prev['prev_url'];
		
	}

	public function pushPrevImg($prev, $type = 0){
		array_push($this->prev_imgs, $prev);
		asort($this->prev_imgs);
		
		$this->_setPreIndex($type, $this->_index);
		$this->_index +=1;
	}
	
	private  function _setPreIndex($type, $index)
	{
		switch($type){
			case 2:
				$this->iicon 	 = $index;break;
			case 3:
				$this->icontact = $index;break;
			case 4:
				$this->imms	 = $index;break; 
		}
	}
	
	private function _getDownloadUrl($channel){
		global $g_arr_host_config;
		$download = sprintf(self::YL_TH_DOWNLOAD_URL, $this->id, $this->cpid, $this->type, $channel, $this->author);
		$url = $g_arr_host_config['host'].$download;
		return $url;
	}

	function setPrevImgs($img_num, $main_url, $prev_imgs){
		$this->mpurl 	= $main_url;
		$this->pnum 	= (int)$img_num;
		$this->prev_imgs 		= $prev_imgs;
	}
	
	public function setProtocol($theme_row, $channel = 0)
	{
		global $g_arr_host;
		$this->id 				= isset($theme_row['identity'])?$theme_row['identity']:'';
		$this->cpid 			= isset($theme_row['cpid'])?$theme_row['cpid']:0;
		$this->type 			= (int)isset($theme_row['type'])?$theme_row['type']:0;
		
		$this->name 			= isset($theme_row['name'])?$theme_row['name']:'';
		$this->enname 			= isset($theme_row['note'])?$theme_row['note']:'';
		
		$this->size 			= (int)isset($theme_row['size'])?$theme_row['size']:0;
		$this->effect 			= isset($theme_row['effect'])?$theme_row['effect']:'';
		$this->font_style 		= isset($theme_row['font_style'])?$theme_row['font_style']:'';
		$this->keyguard_style 	= isset($theme_row['keyguard_style'])?$theme_row['keyguard_style']:'';
		$this->desc		 		= isset($theme_row['note'])?$theme_row['note']:'';
		$this->c_time	 		= isset($theme_row['insert_time'])?$theme_row['insert_time']:'';

		$this->pnum 	= (int)isset($theme_row['img_num'])?$theme_row['img_num']:0;
		
		$this->intro			=  isset($theme_row['intro'])?$theme_row['intro']:'';
		$this->starlevel		=  isset($theme_row['star_level'])?$theme_row['star_level']:'';
		$this->kernel 			= (int)isset($theme_row['kernel'])?$theme_row['kernel']:0;
		
		$this->setCommonParam($theme_row, $channel);
		$this->turl 	= $this->_getDownloadUrl($channel);
		
		$this->ad				= (int)isset($theme_row['ad'])?$theme_row['ad']:0;
		$strAdIcon				= isset($theme_row['adicon'])?$theme_row['adicon']:'';
		global $g_arr_host_config;
		$this->adicon			=  $g_arr_host_config['cdnhost'].$strAdIcon;
		$this->adurl			= isset($theme_row['adurl'])?$theme_row['adurl']:'';
	}
}
?>