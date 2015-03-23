<?php

return [
	'vendorPath' => dirname( dirname( __DIR__ ) ) . '/vendor',
	'components' => [
//		'cache'   => [
//			'class' => 'yii\caching\FileCache',
//		],
		'request' => [
			'enableCookieValidation' => false,
			'enableCsrfValidation'   => false,
		],
		'urlManager' => [
			'class'           => 'yii\web\UrlManager',
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
			'rules'           =>
				[
					'dashboard'                        => 'site/index',
					'POST <controller:\w+>s'           => '<controller>/create',
					'<controller:\w+>s'                => '<controller>/index',
					'PUT <controller:\w+>/<id:\d+>'    => '<controller>/update',
					'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete',
					'<controller:\w+>/<id:\d+>'        => '<controller>/view',
				]
		]
	],
	'aliases' => [
		'@bower' => dirname( dirname( __DIR__ ) ) . '/vendor/bower-asset'
	],
//	'bootstrap' => ['debug'],
	'modules' => [
		'debug' => 'yii\debug\Module',
	],
];
?>