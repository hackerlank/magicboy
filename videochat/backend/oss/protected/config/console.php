<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
	'timeZone'=>'Asia/Chongqing',
	// application components
	'components'=>array(
		'db'=>array(
				'connectionString' => 'mysql:host=172.27.1.123;dbname=chat',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => 'mysql8*',
				'charset' => 'utf8',
				//页面显示sql语句时会加入绑定的参数
				'enableParamLogging'=>YII_DEBUG,
				//'enableProfiling'=>YII_DEBUG,
			),
		'cache' => array(
        	'class' => 'system.caching.CMemCache',
        	'servers' => array(
            	array('host' => '172.27.1.121',
            		'port' => 11211,
            		'weight'=>100),
         	),
         	'keyPrefix' => '',
         	'hashKey' => false,
         	'serializer' => false,
    	),
		// uncomment the following to use a MySQL database
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),

	'params'=>array(
		//图片文件路径
		'imgurl'=>'http://admin.soso.com/img/',
	),
);