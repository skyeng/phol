<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
    require dirname(__FILE__).'/static/main.php',
	
	array(
	
		// autoloading model and component classes
		'import'=>array(
			'application.models.*',
			'application.components.*',
			'application.components.sync.*',
			'application.extensions.sms.*'
		),

		'modules'=>array(
			
		),

		// application components
		'components'=>array(
			
			'urlManager'=>array(
				'urlFormat'=>'path',
				'showScriptName'=> false,
				'rules'=>array(
					'login'=>'login/login',
					'logout'=>'login/logout',
					
					'admin'=>'admin/todo',
					'admin/block'=>'admin/block',
					'admin/scenario/<id:[0-9]+>'=>'admin/scenario',
					'admin/orders'=>'admin/orders',
					'admin/updateVersion'=>'admin/updateVersion',
					
					'admin/<controller:[^\/]+>'=>'<controller>/admin',
					'admin/<controller:[^\/]+>/<action:[^\/]+>'=>'<controller>/<action>',
					'admin/<controller:[^\/]+>/<action:[^\/]+>/<id:[0-9]+>'=>'<controller>/<action>',
					
					'order'=>'site/order',
					'beforeLesson'=>'lesson/beforeLesson',
					'beforeHometask'=>'lesson/beforeHometask',
					'lesson'=>'lesson/index',
					'afterLesson'=>'lesson/afterLesson',
					
					'page/<page_name:how-to-pay|agreement|about|contacts|for-teachers>'=>'site/static'
					
					//'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					//'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					//'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),
			
			'errorHandler'=>array(
				// use 'site/error' action to display errors
				'errorAction'=>'site/error',
			),
		),
	)
);