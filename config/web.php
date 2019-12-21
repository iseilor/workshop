<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'workshop',
    'name' => 'Workshop',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'index',
    'language' => 'ru-RU',
    'defaultRoute' => 'main/default/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@adminlte' => '@vendor/almasaeed2010/adminlte',
    ],
    'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'jk' => [
            'class' => 'app\modules\jk\Module',
        ],

    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'm71YjtB7X51bk2lS2s7sHiedVrgUg2SN',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'linkAssets' => true
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            //'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/jk' => 'app_jk.php',
                        'app/user'=>'app_user.php'
                    ],
                ],
            ],
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,

            'rules' => [
                /*'<_a:(login|logout|signup|email-confirm|request-password-reset|password-reset)>' => 'user/default/<_a>',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<module:[\w-]+>/<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<action:\w+>' => '<module>/default/<action>',
                '<controller>/<action>' => '<controller>/<action>'*/

                '' => 'main/default/index',
                'contact' => 'main/contact/index',
                '<_a:error>' => 'main/default/<_a>',
                '<_a:(login|logout|signup|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',

                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
            ]

        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.1.1', '::1','*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.1.1', '::1','*'],
    ];
}

return $config;
