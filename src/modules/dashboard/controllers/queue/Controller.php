<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers\queue;


use common\widgets\Nav;

class Controller extends \modules\dashboard\Controller
{
    public function init()
    {
        parent::init();
        Nav::setMenu('main-sidebar', [
            ['label' => 'URL 推送', 'url' => ['queue/url/index']],
            ['label' => '新增 URL 推送', 'url' => ['queue/url/create']],
        ]);
    }

    public function accessRules()
    {
        $rules[] = [
            'allow' => true,
            'roles' => ['manageQueue']
        ];
        return $rules;
    }
}