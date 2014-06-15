<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			'cache'=>array(
        		'class' => 'system.caching.CMemCache',
        		'servers' => array(
            		array('host' => '127.1.0.1',
            			  'port' => 11211),
         			),
         		'keyPrefix' => '',
         		'hashKey' => false,
         		'serializer' => false,
    		),
			'db'=>array(
				'connectionString' => 'mysql:host=127.0.0.1;dbname=videochat',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
				//页面显示sql语句时会加入绑定的参数
				'enableParamLogging'=>YII_DEBUG,
				//'enableProfiling'=>YII_DEBUG,
			),
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
					array(
						'class'=>'CFileLogRoute',
						'levels'=>'error, warning, info',
					),
				// uncomment the following to show log messages on web pages
					array(
						'class'=>'CWebLogRoute',
						'categories'=>'system.db.*',
					),
				),
			),
		),
		'modules'=>array(
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'!@#$%^',
				// If removed, Gii defaults to localhost only. Edit carefully to taste.
				'ipFilters'=>array('127.0.0.1','::1'),
			),
		),
		'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		//上传图片路径
		'uploadDir'=>'D:\videochat\code\backend\img\\',
		//图片文件路径
		'imgurl'=>'http://admin.soso.com/img/',
	),
	)
);
