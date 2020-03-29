<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$db = ArrayHelper::merge(
    require(__DIR__ . '/db.php'),
    require(__DIR__ . '/db-local.php')
);
$config = [
    'id' => 'WORKSHOP',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'modules' => [
        /*'simplechat' => [
            'class' => 'bubasuma\simplechat\Module',
        ],*/
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'controllerNamespace' => 'app\modules\admin\commands',
        ],
        'main' => [
            'class' => 'app\modules\main\Module',
            'controllerNamespace' => 'app\modules\main\commands',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
            'controllerNamespace' => 'app\modules\user\commands',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,

    'controllerMap' => [
        'migrate-task' => [
            'class' => 'yii\console\controllers\MigrateController',
            //'migrationNamespaces' => ['app\modules\task\migrations'],
            'migrationPath' => '@app/modules/task/migrations',
            'migrationTable' => 'migration_task',
        ],
        'migrate-pulsar' => [
            'class' => 'yii\console\controllers\MigrateController',
            //'migrationNamespaces' => ['app\modules\task\migrations'],
            'migrationPath' => '@app/modules/pulsar/migrations',
            'migrationTable' => 'migration_pulsar',
        ],
    ],

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
