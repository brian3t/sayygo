<?php

return [
	'vendorPath' => dirname( dirname( __DIR__ ) ) . '/vendor',
	'name'       => 'Sayygo',
	'components' => [
		'formatter'  => [
			'class'          => 'yii\i18n\Formatter',
			'dateFormat'     => 'php:d-M-Y',
			'datetimeFormat' => 'dd/MM/yyyy HH:mm:ss',
			'timeFormat'     => 'php:H:i:s',
		],
//		'cache'   => [
//			'class' => 'yii\caching\FileCache',
//		],
		'request'    => [
//			'enableCookieValidation' => false,
//			'enableCsrfValidation'   => false,
		],
		'urlManager' => [
			'class'           => 'yii\web\UrlManager',
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'rules'           =>
				[
					'dashboard'                        => 'site/index',
					'/site/error'                      => 'site/index',
					'POST <controller:\w+>s'           => '<controller>/create',
					'<controller:\w+>s'                => '<controller>/index',
					'PUT <controller:\w+>/<id:\d+>'    => '<controller>/update',
					'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete',
					'<controller:\w+>/<id:\d+>'        => '<controller>/view',
				]
		],
		'view'       => [
			'theme' => [
				'pathMap' => [
					'@dektrium/user/views' => '@common/views/user'
				],
			],
		],
	],
	'bootstrap'  => [ 'debug' ],
	'modules'    => [
		'debug' => [
			'class'      => 'yii\debug\Module',
			'allowedIPs' => [ '76.88.66.0','198.2.44.170','127.0.0.1','::1' ],
		],
		'user'  => [
			'class'               => 'dektrium\user\Module',
			'modelMap'            => [
				'User'             => 'common\models\User',
				'RegistrationForm' => 'common\models\RegistrationForm',
				'Profile'          => 'common\models\Profile',
			],
			'controllerMap'       => [
				'settings' => 'common\controllers\SettingsController',
				'profile'  => 'common\controllers\ProfileController'
			],
			'mailer'              => [
				'sender'                => 'tri@usvsolutions.com', // or ['no-reply@myhost.com' => 'Sender name']
				'welcomeSubject'        => 'Welcome to Sayygo',
				'confirmationSubject'   => 'Confirmation email from Sayygo',
				'reconfirmationSubject' => 'Email change - Sayygo',
				'recoverySubject'       => 'Recovery email - Sayygo',
			],
			'enableFlashMessages' => false

		],
	],

];
?>