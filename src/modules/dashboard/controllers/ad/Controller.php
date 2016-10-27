<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers\ad;


use common\widgets\Nav;

class Controller extends \modules\dashboard\Controller
{
    public function init()
    {
        parent::init();
        Nav::setMenu('main-sidebar', [
            ['label' => '广告位', 'url' => ['ad/position/index']],
            ['label' => '新增广告位', 'url' => ['ad/position/create']],
            '<li class="divider"><hr></li>',
            ['label' => '广告', 'url' => ['ad/ad/index']],
            ['label' => '新增广告', 'url' => ['ad/ad/create']],
        ]);
    }

    public function accessRules()
    {
        $rules[] = [
            'allow' => true,
            'roles' => ['manageAd']
        ];
        return $rules;
    }
}