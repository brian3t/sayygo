<?php
$params = array_merge(
	require( __DIR__ . '/../../common/config/params.php' ),
	require( __DIR__ . '/../../common/config/params-local.php' ),
	require( __DIR__ . '/params.php' ),
	require( __DIR__ . '/params-local.php' )
);

return [
	'id'                  => 'app-backend',
	'basePath'            => dirname( __DIR__ ),
	'controllerNamespace' => 'backend\controllers',
	'bootstrap'           => [ 'log' ],
	'modules'             => [
		'gii'   => 'yii\gii\Module',
		'debug' => 'yii\debug\Module',
//	    'user' => [
		// following line will restrict access to admin page
//		    'as backend' => 'dektrium\user\filters\BackendFilter',
//	    ],
	],
	'components'          => [
		'log'          => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets'    => [
				[
					'class'  => 'yii\log\FileTarget',
					'levels' => [ 'error','warning' ],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
/* for different sessions on backend and frontend
//	        'session' => [
//		        'name' => 'PHPBACKSESSID',
//		        'savePath' => __DIR__ . '/../tmp',
//		        'cookieParams' => [
//			        'path'=>'http://localhost/b'
//		        ],
//        ],
//        'user' => [
//	        'identityClass' => 'common\models\User',
//	        'enableAutoLogin' => true,
//	        'identityCookie' => [
//		        'name' => '_backendUser', // unique for backend
//		        'path'=>'/b/web'  // correct path for the backend app.
//	        ]
//        ],
*/
	],
	'params'              => $params,

];
