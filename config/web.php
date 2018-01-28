<?php

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';

$config = [
    'id'             => 'basic',
    'name'           => 'AsthmaCare',
    'basePath'       => dirname(__DIR__),
    'bootstrap'      => ['log'],
    // set target language to be Russian
    'language'       => 'ru-RU',
    'charset'        => 'utf-8',
    // set source language to be English
    'sourceLanguage' => 'en-EN',
    'aliases'        => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components'     => [
        /**
         * Компонент интернациональзации
         * настройка config/i18n
         * Основной файл с переводами @app/messages/ru/app.php
         */
        'i18n'         => [
            'translations' => [
                '*' => [
                    'class'          => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-EN',
                ],
            ],
        ],
        /**
         * Переопредение отображений
         */
        'view'         => [
            'theme' => [
                'pathMap' => [
                     #переопределение моудуля dektrium/user
                    '@dektrium/user/views' => '@app/modules/lk/views/user',
                ],
            ],
        ],
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 't1Xd-e0vhaTKeFiP0Euv7W_gTZHNIKls',
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning',
                    ],
                ],
            ],
        ],
        'db'           => $db,
        'urlManager'   => [
            'class'           => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName'  => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules'           => [
                //                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                //                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                //                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                //                '<module:[\wd-]+>/<controller:[\wd-]+>/<action:[\wd-]+>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'modules'        => [
        /**
         * Моудуль отвечающий за регистрацию и авторизацию пользователей
         * @link https://github.com/dektrium/yii2-user
         * Конфигурация
         * @link https://github.com/dektrium/yii2-user/blob/master/docs/configuration.md
         */
        'user'     => [
            'class'                  => 'dektrium\user\Module',
            'modelMap'               => [
                'Profile' => 'app\models\Profile',
            ],
            'enableUnconfirmedLogin' => true,
            'confirmWithin'          => 21600,
            'cost'                   => 12,
            'admins'                 => ['admin'],

        ],
        /**
         * Модуль управление правами пользователей
         * @link https://github.com/dektrium/yii2-rbac/blob/master/docs
         */
        'rbac'     => 'dektrium\rbac\RbacWebModule',
        'lk'       => [
            'class' => 'app\modules\lk\lk',
        ],
        'api'      => [
            'class' => 'app\modules\api\api',
        ],
        'admin'    => [
            'class' => 'app\modules\admin\admin',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
    ],
    'params'         => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
