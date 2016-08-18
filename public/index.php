<?php
//测试中文会不会乱码
// change the following paths if necessary
$yii=dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'yii/framework/yii.php';
$config=dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);

Yii::createWebApplication($config)->run();
