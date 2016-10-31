<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;

use common\clients\baidu\Baidu;
use console\components\BaseConsoleController;

class BaiduController extends BaseConsoleController
{
    public function actionPing($urls)
    {
        if (is_string($urls)) {
            $urls = explode(',', $urls);
        }

        /**
         * @var $baidu Baidu
         */
        $baidu = \Yii::$app->baidu;
        $rs = $baidu->ping($urls);

        print_r($rs);
    }
}