<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers\manage;


use frontend\components\BaseManageController;

class DefaultController extends BaseManageController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}