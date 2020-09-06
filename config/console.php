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
    'timeZone' => 'Europe/Moscow',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'modules' => [
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
        'project' => [
            'class' => 'app\modules\project\Module',
            'controllerNamespace' => 'app\modules\project\commands',
        ],
        'pulsar' => [
            'class' => 'app\modules\pulsar\Module',
            'controllerNamespace' => 'app\modules\pulsar\commands',
        ],
        'video' => [
            'class' => 'app\modules\video\Module',
            'controllerNamespace' => 'app\modules\video\commands',
        ],
        'kr' => [
            'class' => 'app\modules\kr\Module',
            'controllerNamespace' => 'app\modules\kr\commands',
        ],

    ],
    'components' => [
        'ad' => [
            'class' => 'Edvlerblog\Adldap2\Adldap2Wrapper',
            'providers' => [
                'default' => [
                    'autoconnect' => true,
                    'config' => [
                        'account_suffix' => $params['ad']['account_suffix'],
                        'hosts' => $params['ad']['hosts'],
                        'base_dn' => $params['ad']['base_dn'],
                        'username' => $params['ad']['username'],
                        'password' => $params['ad']['password'],
                        'port' => $params['ad']['port'],
                    ],
                ],
            ],
        ],

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

        'urlManager' => [
            'baseUrl' => 'http://workshop/'
        ]
    ],
    'params' => $params,

    'controllerMap' => [
        'migrate-user' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/user/migrations',
            'migrationTable' => 'migration_user',
        ],
        'migrate-news' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/news/migrations',
            'migrationTable' => 'migration_news',
        ],
        'migrate-jk' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/jk/migrations',
            'migrationTable' => 'migration_jk',
        ],
        'migrate-task' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/task/migrations',
            'migrationTable' => 'migration_task',
        ],
        'migrate-pulsar' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/pulsar/migrations',
            'migrationTable' => 'migration_pulsar',
        ],
        'migrate-nsi' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/nsi/migrations',
            'migrationTable' => 'migration_nsi',
        ],
        'migrate-project' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/project/migrations',
            'migrationTable' => 'migration_project',
        ],
        'migrate-chat' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/chat/migrations',
            'migrationTable' => 'migration_chat',
        ],
        'migrate-bot' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/bot/migrations',
            'migrationTable' => 'migration_bot',
        ],
        'migrate-video' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/video/migrations',
            'migrationTable' => 'migration_video',
        ],
        'migrate-kr' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@app/modules/kr/migrations',
            'migrationTable' => 'migration_kr',
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