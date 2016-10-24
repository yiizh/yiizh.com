<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\account;


use common\components\BaseModule;
use common\widgets\Nav;

class Module extends BaseModule
{
    public $layout = 'main';
    public $controllerNamespace = 'modules\account\controllers';

    public function init()
    {
        parent::init();
        Nav::setMenu('user-account', [
            ['label' => '个人资料', 'url' => ['profile/index']],
            ['label' => '修改密码', 'url' => ['security/change-password']],
            ['label' => '账号绑定', 'url' => ['openid/index']],
        ]);
    }
}