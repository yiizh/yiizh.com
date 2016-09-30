<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\helpers;


use common\models\Settings;
use yii\helpers\ArrayHelper;
use yii\web\UrlManager;

class UrlManagerHelper
{
    /**
     * @return UrlManager|Object
     * @throws \yii\base\InvalidConfigException
     */
    public static function getFrontend()
    {
        $config = ArrayHelper::merge(
            require(__DIR__ . '/../../common/config/main.php'),
            require(__DIR__ . '/../../frontend/config/main.php')
        );
        $config['components']['urlManager']['baseUrl'] = Settings::get(Settings::SITE_URL);

        return \Yii::createObject(ArrayHelper::getValue($config,'components.urlManager'));
    }

}