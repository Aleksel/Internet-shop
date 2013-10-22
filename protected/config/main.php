<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Pet-Like интернет магазин',
    // preloading 'log' component
    'preload' => array('log',
	'debug'),
    // autoloading model and component classes
    'import' => array(
	'application.models.*',
	'application.components.*',
	'application.modules.srbac.controllers.SBaseController',
	'ext.yii-mail.YiiMailMessage',
    ),
    'defaultController' => 'main',
    'sourceLanguage' => 'ru',
    'language' => 'ru',
    'theme' => 'classic',
    'modules' => array(
	// uncomment the following to enable the Gii tool

	'gii' => array(
	    'class' => 'system.gii.GiiModule',
	    'password' => 'omatic',
	    // If removed, Gii defaults to localhost only. Edit carefully to taste.
	    'ipFilters' => array('127.0.0.1', '::1'),
	),
//	'srbac' => array(
//	    // Модель для работы с таблицой пользователей
//	    'userclass' => 'User',
//	    // Уникальный идентификатор пользователя
//	    'userid' => 'id',
//	    // Название поля содержащего имя пользователя
//	    'username' => 'name',
//	    // В режиме отладки все пользователи могут управлять правилами доступа
//	    'debug' => true,
//	    // Колличество пунктов выводимых на 1 странице
//	    'pageSize' => 20,
//	    // Название роли супер пользователя
//	    'superUser' => 'Authority',
//	    // Файл стилей для модуля
//	    'css' => 'srbac.css',
//	    // Сообщение для не авторизированных пользователей, попытавшихся получить доступ к закрытым для них разделам сайта
//	    'notAuthorizedView' => 'srbac.views.authitem.unauthorized',
//	    // Операции разрещенные польщователю
//	    'userActions' => array('Show', 'View', 'List', 'Index'),
//	    //
//	    'listBoxNumberOfLines' => 15,
//	    // Путь к картинкам
//	    'imagesPath' => 'srbac.images',
//	    //
//	    'imagesPack' => 'noia',
//	    //
//	    'iconText' => true,
//	),
    ),
    // application components
    'components' => array(
	#'menu'=>array(
	#	'class'=>'MainMenu',
	#),
	'user' => array(
	    // enable cookie-based authentication
	    'allowAutoLogin' => true,
	),
	// uncomment the following to enable URLs in path-format
	'urlManager' => array(
	    'urlFormat' => 'path',
	    'showScriptName' => false,
	    'rules' => array(
		'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
		'srbac/<controller:\w+>/<action:\w+>' => 'srbac/<controller>/<action>',
		/* 'news/<news_name:.*?>'=>'my/news', */
		'catalog/<action:\w+>/<area:\w+>' => 'catalogItems/index',
		'catalog/<action:\w+>' => 'catalog/index',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>/<area:\w+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>/<area:\w+>/<item:\w+>' => '<controller>/<action>',
	    /* '<controller:\w+>/<action:\w+>/<area:\w+>/<item:\w+>/<order:.*?>' => '<controller>/<action>', */
	    ),
	),
	'authManager' => array(
	    'class' => 'CDbAuthManager',
	    'connectionID' => 'db',
//	    'itemTable' => 'AuthItem',
//	    'itemChildTable' => 'AuthItemChild',
//	    'assignmentTable' => 'AuthAssignment',
	    'defaultRoles' => array('Guest'),
	),
	/* 'db'=>array(
	  'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	  ),
	  // uncomment the following to use a MySQL database
	 */
	'db' => array(
	    'connectionString' => 'pgsql:host=localhost;port=5432;dbname=pet-like',
	    'emulatePrepare' => true,
	    'username' => 'postgres',
	    'password' => 'omatic',
	    'charset' => 'utf8',
	    'enableProfiling' => true,
	    'enableParamLogging' => true,
	),
	'errorHandler' => array(
	    // use 'main/error' action to display errors
	    'errorAction' => 'main/error',
	),
	'log' => array(
	    'class' => 'CLogRouter',
	    'routes' => array(
		array(
		    /* 'class' => 'CFileLogRoute',
		      'levels' => 'error, warning', */

            /**
             * Для вывода в консоль
             */
            /*
            'class' => 'ext.phpconsole.PhpConsoleYiiExtension',
		    'handleErrors' => true,
		    'handleExceptions' => true,
		    'basePathToStrip' => dirname($_SERVER['DOCUMENT_ROOT'])*/

            /**
             * Для подключения debug toolbar
             */
            'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
            'ipFilters'=>array('127.0.0.1','192.168.0.194'),


		),
	    // uncomment the following to show log messages on web pages
	    /*
	      array(
	      'class'=>'CWebLogRoute',
	      ),
	     */
	    ),
	),
	'debug' => array(
	    'class' => 'ext.yii2-debug.Yii2Debug',
	),
	'mail' => array(
	    'class' => 'ext.yii-mail.YiiMail',
	    'transportType' => 'smtp',
	    'transportOptions' => array(
		'host' => 'smtp.yandex.ru',
		'username' => 'support@pet-like.ru',
		'password' => 'gBAmj38J',
		'port' => '25',
		'encryption' => 'tls',
	    ),
	    'viewPath' => 'application.views.mail',
	    'logging' => true,
	    'dryRun' => false
	),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
	// this is used in contact page
	'adminEmail' => 'support@pet-like.ru',
    ),
);