<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard;

use common\components\BaseWebController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class Controller extends BaseWebController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => $this->accessRules(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs()
            ]
        ];
    }

    public function accessRules()
    {
        return [
            ['allow'=>true,'roles'=>['manager']]
        ];
    }

    public function verbs()
    {
        return [];
    }
}