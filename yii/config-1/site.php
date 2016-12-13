<?php
/**
 * User: vvpol
 * Date: 21.11.2016
 * Time: 10:07
 */

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'main',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '_yfoV2LOGeHaP6-f9ZTCL9ZfdNj8APcf',
        ],
      //  'cache' => [
      //      'class' => 'yii\caching\FileCache',
      //  ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
      //  'mailer' => [
      //      'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
      //      'useFileTransport' => true,
      //  ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'=>array(
            'class' => 'yii\db\Connection',
            'driverName' => 'mysql',
            'dsn' => 'mysql:host=localhost;dbname=jobpad',
            'username' => 'root',
            'password' => '',
        ),

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<_a:(about|contact|login)>' => 'site/<_a>',
          //      'about' => 'site/about/',
          //      'contact' => 'site/contact',
          //      'login' => 'site/login',
                'jsonrpc' => 'main/jsonrpc'
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
    ];
}
return $config;
