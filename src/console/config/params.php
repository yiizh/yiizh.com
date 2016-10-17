<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

return [
    'crontabs'=>[
        [
            'name' => 'name',
            'rule' => '* * * * *',
            'cmd' => 'php',
            'args' => [
                '@root/bin/console',
                'sitemap/generate'
            ]
        ]
    ]
];