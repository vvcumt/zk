<?php
/*
 * 查询主题列表：
* 	http: get协议
* ?type=theme&reqNum=20&page=0
* 返回结果
* JSON示例
* {
* "total_number": 300
* "ret_number": 20
* "themes":
* [
* 		{
*            "id": 11488058246,
*            “author” : “little”,
*            “name”: “圆圆”
*            “description”:”这是一个团团圆圆的主题”,
*            “them_file_url”: ”../1.theme”,
*             "created_at": "20110406174655",
*             “main_prev_url”: “http://www.coolshow.com/1.jpg“,
*             “prev_img_num”:3,
*             “prev_imgs”:
*             [
*             		{“img_url”: “http://www.coolshow.com/1.jpg”},
*             		{“img_url”:” http://www.coolshow.com/2.jpg”},
*             		{“img_url”:” http://www.coolshow.com/3.jpg”}
*             ]
*      },
*      ...
*],
*}
*/
//以下部分测试通过


require_once 'public/public.php';

$nPage = isset($_GET['page'])?$_GET['page']:0;
$nNum  = isset($_GET['reqNum'])?$_GET['reqNum']:10;
$nStart 	  = $nNum * $nPage;

if(!is_numeric($req_num) || !is_numeric($req_page)){
	echo get_rsp_result(false, 'get param is not num');
	exit; //错误请求
}

require_once("tasks/CoolShow/CoolShowSearch.class.php");

$nCoolType = (int)(isset($_GET['mtype'])?$_GET['mtype']:COOLXIU_TYPE_THEMES);

$coolshow = new CoolShowSearch();
$json_result = $coolshow->getCoolShow($nCoolType, $nStart, $nNum);

echo $json_result;

require_once 'tasks/Records/RecordTask.class.php';
$rt = new RecordTask();
$rt->saveRequest($type);