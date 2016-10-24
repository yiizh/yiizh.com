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
        $user = \Yii::$app->user;
        Nav::addMenuItem('main-navbar', [
            'label' => '新闻',
            'url' => ['news/index'],
            'visible'=>$user->can('manageNews')
        ]);
        Nav::addMenuItem('main-navbar', [
            'label' => '系统',
            'url' => ['system/index'],
            'visible'=>$user->can('manage')
        ]);

    }
}