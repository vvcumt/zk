<?php
require_once 'configs/config.php';
require_once 'tasks/statis/Product.class.php';

abstract class CoolShow
{
	protected $_strProduct;
	protected $_nType;			//分类
	protected $_nKernel;		//酷秀版本内核
	protected $_nVercode;		//酷秀应用版本号
	protected $_nWidth;			
	protected $_nHeight;
	protected $_nChannel;		//渠道号，区分访问来源
	public    $_bSceneWallpaer; //是否锁屏壁纸
	public 	  $_nSort;			//排序规则，默认为时序+手动调整 1:LAST/2:HOT/3:CHOICE/4:HOLIDAY
	
	public 	  $_nProtocolCode;	//新增协议版本 ，作为软件版本依据20141028
	
	protected $_bNewVer;		//表示新旧版本，区分新旧版锁屏
	protected $_product;		//产品名称

	protected $_bWidgetBanner;	//是否通过应用推荐的Banner获取
	
	public    $nCharge;			//是否付费资源  -1：全部 0:免费 1：付费 2:全部 20150504
	public    $bHavePaid;		//是否有付费资源
	public 	  $nPay;			// 付费资源数量（比例）
	public    $nFree;			// 免费资源数量（比例）
	protected $strPayCondition;	// 查询中的付费条件
	
	function __construct()
	{
		$this->_nType		= 0;
		$this->_nKernel		= 0;
		$this->_nVercode	= 0;		
		$this->_nWidth		= 0;
		$this->_nHeight		= 0;
		$this->_nChannel	= 0;
		$this->_nProtocolCode = 0;
		$this->_nSort		= 0;
		$this->nCharge		= 2;
		$this->bHavePaid	= false;
		$this->nPay			= 1;
		$this->nFree		= 1;
		$this->strPayCondition = '';
		$this->_bSceneWallpaer = false;
	}

	public function setSceneWallpaper($bSceneWallpaper)
	{
		$this->_bSceneWallpaer = $bSceneWallpaper;
	}
	
	public function getStart($bPay, $start)
	{
		$nTemp = $bPay?$this->nPay:$this->nFree;
		$nStart = $start * $nTemp / ($this->nFree + $this->nPay);
		return $nStart;
	}
	public function getLimit($bPay, $limit)
	{
		$nTemp = $bPay?$this->nPay:$this->nFree;
		$nLimit = $limit * $nTemp / ($this->nFree + $this->nPay);
		return $nLimit;
	}
	
	public function setPay($bPay)
	{
		if($this->nCharge != 2){
			return;
		}
		
		if($bPay){
			$this->strPayCondition  = ' AND ischarge = 1 ';
		}else{
			$this->strPayCondition  = ' AND ischarge = 0 ';
		}
	}
	
	/**
	 * 新版本独立获取收费或免费信息 
	 * @return string
	 */
	public function getCharge()
	{
		$strCondition = '';
		if (empty($this->strPayCondition)){
			$strCondition = sprintf( ' AND ischarge = %d ', $this->nCharge);
		}		
		return $strCondition;
	}
	
	
	public function setKernel($nKernel)
	{
		$this->_nKernel	= $nKernel;
	}

	public function getKernel()
	{
		return $this->_nKernel;
	}
	
	public function setChannel($nChannel)
	{
		$this->_nChannel = $nChannel;
	}
	
	public function setRatio($nWidth, $nHeight)
	{		
		$this->_nWidth		= $nWidth;
		$this->_nHeight		= $nHeight;
	}
	
	public function setParam($nType,
							$nWidth, $nHeight,
							$nSort,
							$nVercode,$nKernel, $nProtocolCode,
							$nCharge )
	{
		$this->_nType			= $nType;
		$this->_nKernel			= $nKernel;
		$this->_nVercode		= $nVercode;
		$this->_nWidth			= $nWidth;
		$this->_nHeight			= $nHeight;
		$this->_nSort			= $nSort;
		$this->_nProtocolCode 	= $nProtocolCode;
		$this->nCharge 			= $nCharge;
	}
	
	protected function _resetRatio()
	{
		if(($this->_nWidth == 960 && $this->_nHeight == 854)
				||($this->_nWidth == 960 && $this->_nHeight == 960)
				||($this->_nWidth == 1080 && $this->_nHeight == 888)){
		
			$this->_nWidth 	  = 1080;
			$this->_nHeight   = 960;
		}
		
		if($this->_nHeight == 1184){
			$this->_nHeight   = 1280;
		}
		
		if($this->_nHeight == 1776){
			$this->_nHeight   = 1920;
		}
	}
	
	public function getLuceneParam($nCoolType, $strKeyWord, $nPage = 0, $nLimit = 1000)
	{
		$this->_resetRatio();
		$datas = 'keyword='.$strKeyWord.'&iscolor=0';

		$datas .= '&subtype='.$nCoolType;
		$datas .= '&width='.$this->_nWidth;
		$datas .= '&height='.$this->_nHeight;
			
		if ($nCoolType == COOLXIU_TYPE_THEMES 
				|| $nCoolType == COOLXIU_TYPE_SCENE){
			if (!empty($this->_nKernel)){
				$datas .= '&kernel='.$this->_nKernel;
			}	
		}		
		
		$datas .= '&page='.$nPage;
		$datas .= '&numreq='.$nLimit;

		$datas = preg_replace("/\s+/", "%20", $datas);
		return $datas;
	}
	
	abstract function setPayRatio();
	abstract function getCoolShowListSql($nStart = 0, $nLimit = 0);
	abstract function getCoolShowCountSql();
	abstract function getSelectAlbumsSql($strId, $nStart = 0, $nNum = 100);
	abstract function getSelectBannerSql();
	abstract function getSelectRscSql($id);
	abstract function getSelectInfoByIdSql($id, $nChannel = 0);
	
// 	abstract function getCoolShowDetailSql($strId);
	
	abstract function getLucene($rows);
	
	abstract function getCoolShowWebSql($nSortType, $nStart = 0, $nLimit = 10);
	abstract function getCoolShowWebCountSql();
	
	abstract function getProtocol($rows, $type = 0);
	abstract function getBannerProtocol($rows, $nType = 0);
	abstract function getWebProtocol($rows);
}