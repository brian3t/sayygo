<?php

return [
	'vendorPath' => dirname( dirname( __DIR__ ) ) . '/vendor',
	'name'       => 'Sayygo',
	'components' => [
		'assetManager' => [
			'class'   => 'yii\web\AssetManager',
			'bundles' => [
				'yii\web\JqueryAsset'          => [
					'js' => [
						'jquery.min.js'
					]
				],
				'yii\bootstrap\BootstrapAsset' => [
					'css' => [
						'css/bootstrap.min.css',
					],
					'js'  => [
						'js/bootstrap.min.js',
					]
				],
			],
		],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
        ],
            'formatter'    => [
			'class'          => 'yii\i18n\Formatter',
			'dateFormat'     => 'php:d-M-Y',
			'datetimeFormat' => 'dd/MM/yyyy HH:mm:ss',
			'timeFormat'     => 'php:H:i:s',
		],
//		'cache'   => [
//			'class' => 'yii\caching\FileCache',
//		],
		'request'      => [
//			'enableCookieValidation' => false,
//			'enableCsrfValidation'   => false,
		],
		'urlManager'   => [
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
					[
						'pattern' => 'communication/create/<fromuserid:\d+>/<touserid:\d+>/<sayygoid:\w+>/<emailqueueid:\d+>',
						'route' => 'communication/create',
						'defaults' => ['fromuserid' => null, 'touserid' => null, 'sayygoid' => null, 'emailqueueid' => null],
					],
				]
		],
		'view'         => [
			'theme' => [
				'pathMap' => [
					'@dektrium/user/views' => '@common/views/user'
				],
			],
		],
		'mailer'       => [
			'class'    => 'yii\swiftmailer\Mailer',
			'viewPath' => '@common/mail',
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'smtp.gmail.com',
				'username' => 'support@sayygo.com',
				'password' => 'Terrace3333',
				'port' => '587',
				'encryption' => 'tls',
			],
		],
	],
//	'bootstrap'  => [ 'debug' ],
	'modules'    => [
//		'debug' => [
//			'class'      => 'yii\debug\Module',
//			'allowedIPs' => [ '76.88.66.0','198.2.44.170','127.0.0.1','::1' ],
//		],
        'gridview' => [
            'class' => '\kartik\grid\Module',
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
                'profile'  => 'common\controllers\ProfileController',
				'security'  => 'common\controllers\SecurityController'
			],
			'mailer'              => [
				'sender'                => 'matching-service@sayygo.com', // or ['no-reply@myhost.com' => 'Sender name']
				'welcomeSubject'        => 'Welcome to Sayygo',
				'confirmationSubject'   => 'Confirmation email from Sayygo',
				'reconfirmationSubject' => 'Email change - Sayygo',
				'recoverySubject'       => 'Recovery email - Sayygo',
			],
			'enableFlashMessages' => true,
            'admins' => ['ngxtri']

		],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],

    ],

];
?>