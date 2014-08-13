<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'RotaConsecrata',
	'sourceLanguage'=>'en-GB',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'T3J@5',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'rights'=>array(
			'userClass' => 'Users',
			'install'=>true
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
#			'allowAutoLogin'=>true,
			'class'=>'MyWebUser',
		),
		'authManager' => array(
			'class' => 'RDbAuthManager',
			'assignmentTable' => 'authassignment',
			'itemTable' => 'authitem',
			'itemChildTable' => 'authitemchild',
			'rightsTable' => 'rights',
			'defaultRoles' => array('Guest', 'Authenticated'),
		),
		'email' => array(
			'class' => 'application.extensions.email.Email',
			'delivery' => 'php', # debug for debugging
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
		'db'=>require(dirname(__FILE__).DIRECTORY_SEPARATOR.'dbconf.php'),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace',
					'categories'=>'system.*, application.*',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>CMap::mergeArray(
		array(
			// this is used in contact page
			'adminEmail'=>'admin@sanjosesolutions.in',
			'logoPath'=>'/images/rc-logo1.png',
		),
		require(dirname(__FILE__).DIRECTORY_SEPARATOR.'params.php')
	),
);
