<?php
/**
 *
 * User: vvpol
 * Date: 25.11.2016
 * Time: 9:52
 */
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/gii.php');
$app = new yii\web\Application($config);

$app->run();
Yii::$app->response->redirect(['127.0.0.1/tool.php?r=gii']);
