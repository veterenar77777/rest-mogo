<?php
/**
 * Created by PhpStorm.
 * User: plasmo
 * Date: 02.11.2019
 * Time: 11:11
 */

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php';

$config = require  dirname(__DIR__) . '/config/web.php';

(new yii\web\Application($config))->run();