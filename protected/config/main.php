<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'深圳广明发客户关系管理系统',
	// preloading 'log' component
	'preload'=>array('log'),
        'language'=>'zh_cn',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.User.models.*',
                'zii.widgets.grid.CGridView',
                'application.extensions.*',
                'application.extensions.PHPExcel.*',
        ),
        'defaultController'=>'User/users/admin',
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'User',
		'Customer',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        'Finance',
        'Custtype',
        'Dictionary',
        'Service',
		'Chance',
		'Statistic',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			//'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
                'items'=>  require_once '/menu.php', 
                'SMS'=>array(
                    'url'=>'http://210.5.158.31:9011/hy/',
                    'uid'=>'50013',
                    'auth'=>'b201fee180e200c342aadc639f2a0ee5',
                    'encode'=>'UTF-8',
                    'expid'=>0, 
                ),
                'SMS_RETURN_CODE'=>array( 
                    0=>"发送成功",
                    1=>"签权失败",
                    2=>"未检索到被叫号码",
                    3=>"被叫号码过多",
                    4=>"内容未签名",
                    5=>"内容过长",
                    6=>"余额不足",
                    7=>"暂停发送",
                    8=>"保留",
                    9=>"定时发送时间格式错误",
                    10=>"下发内容为空",
                    11=>"账户无效",
                    12=>"Ip地址非法",
                    13=>"操作频率快",
                    14=>"操作失败",
                    15=>"拓展码无效(1-999)",
                ),
                'UNCALL'=>array(
                    'webservice'=>'',
                ),
	),
        //短信服务商配置
        
);




