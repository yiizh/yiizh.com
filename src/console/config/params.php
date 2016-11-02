<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

return [
    'crontabs'=>[
        [
            'name' => 'sitemap-generator',
            // 每天早晨6点执行生成 sitemap
            'rule' => '0 6 */1 * *',
            'cmd' => 'php',
            'args' => [
                '@root/bin/console',
                'sitemap/generate'
            ]
        ],
        [
            // 搜索引擎推送，白天: 08-22 点之间，每隔10分钟推送一次
            'name' => 'spider-push',
            'rule' => '*/10 8-22 * * *',
            'cmd' => 'php',
            'args' => [
                '@root/bin/console',
                'spider/push'
            ]
        ],
    ]
];