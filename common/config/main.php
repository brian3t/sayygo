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
                'yii\bootstrap\BootstrapPluginAsset' => [
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
					'user/settings/confirm'      => 'site/index',
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
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute
            'displaySettings' => [
                'date' => 'd-m-Y',
                'time' => 'H:i:s A',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            // format settings for saving each date attribute
            'saveSettings' => [
                'date' => 'Y-m-d',
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],



            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

        ],

        'user'  => [
			'class'               => 'dektrium\user\Module',
			'modelMap'            => [
				'User'             => 'common\models\User',
				'RegistrationForm' => 'common\models\RegistrationForm',
				'Profile'          => 'common\models\Profile',
				'Token'             => 'common\models\Token',
				'SettingsForm'      => 'common\models\SettingsForm'
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
			'enableFlashMessages' => false,
            'admins' => ['ngxtri']

		],
        'rbac' => [
            'class' => 'dektrium\rbac\Module',
        ],

    ],

];
?>