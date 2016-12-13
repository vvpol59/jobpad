<?php
/**
 * User: vvpol
 * Date: 28.09.2016
 * Time: 21:48
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/yii/vendor/autoload.php');
require(__DIR__ . '/yii/vendor/yiisoft/yii2/Yii.php');

 $config = require(__DIR__ . '/yii/config/site.php');

$app = new yii\web\Application($config);
$app->run();
