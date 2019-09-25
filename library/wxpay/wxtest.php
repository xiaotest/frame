<?php
require_once dirname(__DIR__).'/../common/includes.php';

//初始化日志 注意日志目录 /../
$logHandler = new CLogFileHandler(dirname(__DIR__)."/../log/" . date('Y-m-d') . '.log');
$log = Log::Init($logHandler, 15);

Log::DEBUG('wxpay '.'6789');