<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'enableCsrfValidation' => false,  // Запрет Csrf контроля(токены)
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '_yfoV2LOGeHaP6-f9ZTCL9ZfdNj8APcf',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]

        ],
        // Запрет автоматической загрузки скриптов
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => ['yii\web\JqueryAsset' => [
                'sourcePath' => null,
                'js' => []
            ],
                'yii\web\YiiAsset' => [
                    'sourcePath' => null,
                    'js' => []
                ]
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
            'enableSession' => true
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db'=>[
            'class' => 'yii\db\Connection',
            'driverName' => 'mysql',
            'dsn' => 'mysql:host=localhost;dbname=jobpad',
            'username' => 'root',
            'password' => '',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                'samogon/<article:[\w_\/^\?-]+>/<par:[\w_\/-]+>' => 'site/show',  // article - имя параметра в action (actionShow($article ...) )
          //      'samogon/<p1:[\w_\/-]+>/<p2:[\d\w]+>'=>'site/show',
                '<_a:(about|contact|login|logout|jobpad|samogon)>' => 'site/<_a>',
                'jsonrpc' => 'json/index',
    //            'class' => 'yii\rest\UrlRule', 'controller' => 'user'
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1']
    ];
}

return $config;
