<?php
/**
 * 系统配置文件，作为全局变量的部分可以存放此处
 * 
 * @author: lijie1@yulong.com
 */

/**
 * 主机相关参数
 *
 * @var unknown_type
 */
$g_arr_host_config = array(
		"host" => 'http://localhost/phpproject/coolshow',
		"cdnhost" => 'http://download.coolyun.com',
		"androidwp_host" => 'http://static.androidesk.com/download/',
		"androidwp_local_host" => 'http://coolpadshow.yulong.com/',
		"chargerecod_host" => 'http://coolpadshow.yulong.com/',
);

/**
	讯飞铃声合作跳转地址
 */
$g_arr_xring_config = array(
		'xunfei' => 'http://61.191.24.229:2069/coolpadapp/',
		'hot' => 'http://iring.diyring.cc/friend/457c2a926a3c3cd7',
		'vip' => 'http://iring.diyring.cc/vip/457c2a926a3c3cd7',
		'ss' => 'http://iring.diyring.cc/ss/457c2a926a3c3cd7?word=%s',
);
/**
 *数据库连接相关参数
 *
 * @var unknown_type
 */
$g_arr_db_config = array(
	'coolshow'=>array("host" =>"localhost",
					"user" => "root", 
					"pwd"  => "1q2w3e4r5t",
					"type" => "commit",
					"coding" => "utf8",
					"db"   => "db_yl_themes"
				),
	'designer'=>array("host" =>"localhost",
					"user" => "root", 
					"pwd"  => "1q2w3e4r5t!@#",
					"type" => "commit",
					"coding" => "utf8",
					"db"   => "db_yl_designer"
				),
	'androidesk'=>array("host" =>"localhost",
				"user" => "root",
				"pwd"  => "1q2w3e4r5t",
				"type" => "commit",
				"coding" => "utf8",
				"db" => "db_yl_androidesk"
	),
	'coolshow_record'=>array("host" =>"localhost",
					"user" => "root",
					"pwd"  => "1q2w3e4r5t!@#",
					"type" => "commit",
					"coding" => "utf8",
					"db"   => "db_yl_themes_records"
				),
	'coolshow_scene'=>array("host" =>"172.16.45.49",
					"user" => "root",
					"pwd"  => "1q2w3e4r5t!@#",
					"type" => "commit",
					"coding" => "utf8",
					"db"   => "db_yl_elflockscreen"
				),
	'coolshow_charge_record'=>array('host' =>'localhost',
				'user' => 'coolshow',
				'pwd'  => '7ujm&UJM6yhn^YHN',
				'type' => 'commit',
				'coding' => 'utf8',
				'db'   => 'db_yl_coolshow_charge_records'
		),
	'recommend'=>array('host' =>'localhost',
				'user' => 'root',
				'pwd'  => '1q2w3e4r5t!@#',
				'type' => 'commit',
				'coding' => 'utf8',
				'db'   => 'db_yl_recommend'
		),
		
	
);

/**
 *日志队列服务器
 */
$g_arr_queue_config = array(
	'request'=>array(
				0=>'queue_theme_req',
				2=>'queue_wp_req',
				3=>'queue_wp_req',
				4=>'queue_ring_req',
				5=>'queue_font_req',
				6=>'queue_scene_req',
				13=>'queue_livewp_req',
				14=>'queue_alarm_req',
		        15=>'queue_theme_req',
		        16=>'queue_theme_req',
		        17=>'queue_theme_req',
			),
	'browse'=>array(
				0=>'queue_theme_browse',
				2=>'queue_wp_browse',
				3=>'queue_wp_browse',
				4=>'queue_ring_browse',
				5=>'queue_font_browse',
				6=>'queue_scene_browse',
				13=>'queue_livewp_browse',
				14=>'queue_alarm_browse',
				15=>'queue_theme_browse',
				16=>'queue_theme_browse',
				17=>'queue_theme_browse',
			),
	'dl'=>array(
				0=>'queue_theme_dl',
				2=>'queue_wp_dl',
				3=>'queue_wp_dl',
				4=>'queue_ring_dl',
				5=>'queue_font_dl',
				6=>'queue_scene_dl',
				13=>'queue_livewp_dl',
				14=>'queue_alarm_dl',
			),
	'apply'=>array(
				0=>'queue_theme_apply',
				2=>'queue_wp_apply',
				3=>'queue_wp_apply',
				4=>'queue_ring_apply',
				5=>'queue_font_apply',
				6=>'queue_scene_apply',
				13=>'queue_livewp_apply',
				14=>'queue_alarm_apply',
			),
	'banner'=>array(
				0=>'queue_theme_banner',
				2=>'queue_wp_banner',
				3=>'queue_wp_banner',
				4=>'queue_ring_banner',
				5=>'queue_font_banner',
				6=>'queue_scene_banner',
				13=>'queue_livewp_banner',
				14=>'queue_alarm_banner',
			),			
	'albums'=>array(
				0=>'queue_theme_albums',
				2=>'queue_wp_albums',
				3=>'queue_wp_albums',
				4=>'queue_ring_albums',
				5=>'queue_font_albums',
				6=>'queue_scene_albums',
				13=>'queue_livewp_albums',
				14=>'queue_alarm_albums',
		),
	'server'=>array(								
			'host' 		=> '172.16.45.106',
			'port' 		=> 6369,
	),
);

/**
 *访问记录MongoDB数据库
 */
$g_arr_mongo_db_config = array('coolshow_record'=>array(
									'host' =>'localhost',
									'port' =>27017,
									'db'=>'db_yl_coolshow_records',
									'cmd'=>'$'
									));

//Memcache,支持多个分布式(地址,端口,权重)
$g_arr_memcache_config= array(array('host'=>'127.0.0.1', 'port'=>'11211', 'persistent'=>true,'weight'=>2),
							  array('host'=>'127.0.0.1', 'port'=>'11211', 'persistent'=>true,'weight'=>2)
							 );

define('YL_SEARCH_LUCENE_URL', 'http://172.16.45.67:8080');


define("COOLXIU_TYPE_THEMES", 0);
define("COOLXIU_TYPE_PREV", 1);
define("COOLXIU_TYPE_WALLPAPER", 2);
define("COOLXIU_TYPE_ANDROIDESK_WALLPAPER", 3);
define("COOLXIU_TYPE_RING", 4);
define("COOLXIU_TYPE_FONT", 5);
define("COOLXIU_TYPE_SCENE", 6);
define("COOLXIU_TYPE_WIDGET", 7);
define("COOLXIU_TYPE_ALBUMS", 8);
define("COOLXIU_TYPE_BANNER", 9);
define("COOLXIU_TYPE_SCENE_WALLPAPER", 10);	//锁屏壁纸
define("COOLXIU_TYPE_ALL", 11);				//搜索全部资源用
define("COOLXIU_TYPE_LIVE_WALLPAPER", 13);	//动态壁纸
define("COOLXIU_TYPE_ALARM", 14);			//闹钟铃声

define("COOLXIU_TYPE_THEMES_CONTACT", 15);
define("COOLXIU_TYPE_THEMES_MMS", 16); #废弃
define("COOLXIU_TYPE_THEMES_ICON", 17);

define("COOLXIU_TYPE_PUSH_H5", 18);    


define("COOLXIU_TYPE_X_RING", 12);		//酷秀第三方合作铃声

define("COOLXIU_TYPE_SETTING", 21);		//酷秀设置项
define("COOLXIU_TYPE_MY_RSC", 22);		//酷秀第三方合作铃声

define('COOLXIU_TYPE_PREV_BROWSER', 1);
define('COOLXIU_TYPE_PREV_COMMON', 0);


define("COOLXIU_TAG_CHOICE",  '小编推荐');

define("COOLXIU_SEARCH_COMMEN",  0);
define("COOLXIU_SEARCH_HOT",     1);
define("COOLXIU_SEARCH_CHOICE",  2);#小编推荐2015.4.28
define("COOLXIU_SEARCH_LAST",    3);
define("COOLXIU_SEARCH_HOLIDAY", 4);


define("COOLXIU_SEARCH_WALLPAPER_COMMEN", 		0);
define("COOLXIU_SEARCH_WALLPAPER_ABSTRACT",  	1);
define("COOLXIU_SEARCH_WALLPAPER_PERSON",    	2);
define("COOLXIU_SEARCH_WALLPAPER_LANDSCAPE",    3);
define("COOLXIU_SEARCH_WALLPAPER_PLANT",	    4);
define("COOLXIU_SEARCH_WALLPAPER_KATUN",   	 	5);
define("COOLXIU_SEARCH_WALLPAPER_ANIMAL",    	6);
define("COOLXIU_SEARCH_WALLPAPER_OTHER",    	7);


define('REQUEST_CHANNEL_COMMEN',    0);
define('REQUEST_CHANNEL_WEB',    	1);
define('REQUEST_CHANNEL_RSC',    	2);
define('REQUEST_CHANNEL_ALBUMS',    3);
define('REQUEST_CHANNEL_WIDGET',    4);
define('REQUEST_CHANNEL_BANNER',    5);
define('REQUEST_CHANNEL_WIDGET_BANNER',    6);
define('REQUEST_CHANNEL_LUCENE',    7);
define('REQUEST_CHANNEL_MYDESIGNER',   8);
define('REQUEST_CHANNEL_RECOMMENED',    9);
define('REQUEST_CHANNEL_CHARGE_NO',    10);
define('REQUEST_CHANNEL_CHARGE_YES',    11);
define('REQUEST_CHANNEL_CHOICE',    12);

define('REQUEST_CHANNEL_LIVEWP',    13);
define('REQUEST_CHANNEL_CONTACT',    15);
define('REQUEST_CHANNEL_ICON',    17);
//安卓壁纸

/**
 * MODIFY BY liangweiwei@yulong.com AT 2012-08-03
 */

defined("ADDRESS_ANDROIDESK")
		or define ("ADDRESS_ANDROIDESK","http://static.androidesk.com/download/");

defined("ADDRESS_COOLXIU")
		or define("ADDRESS_COOLXIU","http://coolpadshow.yulong.com/wallpaper/");

defined("ANDROID_WP_DB_FLAG")
		or define("ANDROID_WP_DB_FLAG",  true); // true代表使用安卓壁纸数据库，false代表使用本地数据库
		

$g_arr_tablename = array(
					"commend",    //0
					"women",      //1
					"landscape",  //2
					"vision",     //3
					"cartoon",    //4
					"city",       //5
					"sensibility",//6
					"originality",//7
					"animal",     //8
					"engine",     //9
					"game",       //10
					"scenery",    //11
					"male",       //12
					"art",        //13
					"sport",      //14
					"movie",      //15
					"others",	  //16
					"hdorigin",	  //17  
					"star",		  //18
					"font");	  //19  
		
?>