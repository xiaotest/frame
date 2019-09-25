<?php
require_once dirname(__DIR__).'/common/includes.php';
$db = new mysql(WxPayConfig::sqlHOST,WxPayConfig::mysqlname, WxPayConfig::mysqlpaw, WxPayConfig::dbname);
$sqlstr = "select  *  from  wadragon_10000.orders";
$db->query($sqlstr);
$result= $db->fetchArray(MYSQL_ASSOC);
$str=createNonceStr();
//初始化日志 注意日志目录 ../
$logHandler = new CLogFileHandler(dirname(__DIR__)."/log/" . date('Y-m-d') . '.log');
$log = Log::Init($logHandler, 15);
Log::DEBUG('res'.$str);


