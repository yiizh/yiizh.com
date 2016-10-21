<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace api\controllers;

use api\components\BaseApiController;
use api\components\ErrorAction;

class SiteController extends BaseApiController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::className()
            ]
        ];
    }

    public function actionIndex()
    {
        return [
            'welcome' => 'Hello World!'
        ];
    }
}