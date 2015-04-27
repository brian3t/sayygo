<?php

Yii::setAlias('@runnerScript', dirname(dirname(__DIR__)) . '/yii');

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'console\controllers',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'controllerMap' => [
	    'cron' => [
		    'class' => 'mitalcoi\cronjobs\CronController',
		    'cronJobs' =>[
			    'match/matchall' => [
				    'cron'      => '* * * * *',
			    ],
			    'match/purge' => [
				    'cron'      => '10 * * * *',
			    ],

		    ],
	    ],
    ],
    'params' => $params,
];



