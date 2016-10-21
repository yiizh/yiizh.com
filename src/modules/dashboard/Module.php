<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard;

use common\components\BaseModule;
use common\widgets\Nav;

class Module extends BaseModule
{
    public $layout = 'main';

    public $controllerNamespace = 'modules\dashboard\controllers';

    public function init()
    {
        parent::init();
        Nav::addMenuItem('main-navbar', [
            'label' => '系统',
            'url' => ['system/index']
        ]);
    }
}