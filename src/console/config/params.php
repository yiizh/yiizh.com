<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

return [
    'crontabs' => [
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
            'name' => 'baidu-push',
            'rule' => '*/10 8-22 * * *',
            'cmd' => 'php',
            'args' => [
                '@root/bin/console',
                'baidu/push'
            ]
        ],
        [
            // 邮件发送，白天: 08-22 点之间，每隔15分钟发送一次
            'name' => 'mail-push',
            'rule' => '*/15 8-22 * * *',
            'cmd' => 'php',
            'args' => [
                '@root/bin/console',
                'mail/auto-send'
            ]
        ],
        [
            // 爬取订阅数据，白天: 08-22 点之间，每隔30分钟爬取一次
            'name' => 'spider-subscription',
            'rule' => '*/30 8-22 * * *',
            'cmd' => 'php',
            'args' => [
                '@root/bin/console',
                'spider/subscription'
            ]
        ],
        [
            // 内容池更新提醒，白天: 08-22 点之间，每隔15分钟提醒一次
            'name' => 'content-pool-notify',
            'rule' => '*/15 8-22 * * *',
            'cmd' => 'php',
            'args' => [
                '@root/bin/console',
                'content-pool/notify'
            ]
        ],
    ]
];