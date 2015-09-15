<?php

class HotWord
{
	const YL_SQL_HOTWORD = 'SELECT hotword FROM tb_yl_hotword WHERE cooltype = %d ';
	public function __construct()
	{
	}
	
	public function getSelectHotWordSql($nCoolType)
	{
		$sql = sprintf(self::YL_SQL_HOTWORD, $nCoolType);
		return $sql;
	}
}