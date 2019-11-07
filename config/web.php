<?php
/**
 * Created by PhpStorm.
 * User: plasmo
 * Date: 04.11.2019
 * Time: 11:28
 */
define('YII_ENABLE_ERROR_HANDLER', false);
$config = [
    'id' => 'test',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'api/index',
    'components' => [
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://admin:1234@localhost:27017/tbdb',
        ],
        'errorHandler' => [
            'errorAction' => 'api/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/api/v1/posts'=>'api/posts'
            ],
        ]
    ],
];
return $config;