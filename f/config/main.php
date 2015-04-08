<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
/* for different sessions on backend and frontend
//        'user' => [
//	        'identityClass' => 'common\models\User',
//	        'enableAutoLogin' => true,
//	        'identityCookie' => [
//		        'name' => '_frontendUser', // unique for front
//		        'path'=>'/f/web'  // correct path for the front app.
//	        ]
//        ],
//        'session' => [
//	        'name' => 'PHPFRONTSESSID',
//	        'savePath' => __DIR__ . '/../tmp',
//        ],
*/
    ],
    'modules' => [
//	    'user' => [
		    // following line will restrict access to admin page
//		    'as frontend' => 'dektrium\user\filters\FrontendFilter',
//	    ],
    ],
    'params' => $params,

];
