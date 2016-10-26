<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\components;

use yii\web\UrlManager;

interface AddUrlRulesInterface
{
    /**
     * 增加 URL Rules
     * @param $urlManager UrlManager
     * @return void
     */
    public function addUrlRulesTo($urlManager);
}