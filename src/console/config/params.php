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
        ]
    ]
];