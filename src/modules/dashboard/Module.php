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
            'label' => '文章',
            'url' => ['post/index'],
            'visible'=>$user->can('managePost')
        ]);
        Nav::addMenuItem('main-navbar', [
            'label' => '项目',
            'url' => ['project/index'],
            'visible'=>$user->can('manageProject')
        ]);
        Nav::addMenuItem('main-navbar', [
            'label' => '广告',
            'url' => ['ad/default/index'],
            'visible'=>$user->can('manageAd')
        ]);
        Nav::addMenuItem('main-navbar', [
            'label' => '队列',
            'url' => ['queue/default/index'],
            'visible'=>$user->can('manageAd')
        ]);
        Nav::addMenuItem('main-navbar', [
            'label' => '系统',
            'url' => ['system/index'],
            'visible'=>$user->can('manage')
        ]);

    }
}