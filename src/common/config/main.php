<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

return [
    'name' => 'Yii中文',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'bootstrap' => [
        'log',
        'common\Bootstrap'
    ],
    'vendorPath' => APP_ROOT . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'defaultTimeZone' => 'Asia/Shanghai',
            'datetimeFormat' => 'php:Y-m-d H:i',
            'dateFormat' => 'php:Y-m-d',
            'timeFormat' => 'php:H:i:s',
            'nullDisplay' => '无'
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=' . getenv('MYSQL_HOST') . ';dbname=' . getenv('MYSQL_DB'),
            'username' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASS'),
            'tablePrefix' => 'tbl_',
            'charset' => 'utf8',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'weibo' => [
                    'class' => 'common\auth\clients\Weibo'
                ]
            ]
        ],
    ],
];