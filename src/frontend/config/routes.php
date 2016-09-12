<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

return [
    '/user/<userId:\d+>' => '/user/default/index',
    '/user/<userId:\d+>/<controller:[\w-]+>' => '/user/<controller>/index',
    '/user/<userId:\d+>/<controller:[\w-]+>/<action:[\w-]+>' => '/user/<controller>/<action>',

    '/user/manage' => '/user/manage/default/index',
    '/user/manage/<controller:[\w-]+>/<action:[\w-]+>' => '/user/manage/<controller>/<action>',

];