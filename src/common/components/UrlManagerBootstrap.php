<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\components;

use common\models\Settings;
use yii\base\BootstrapInterface;

class UrlManagerBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        \Yii::$app->getUrlManager()->baseUrl = Settings::get(Settings::SITE_URL);

        foreach ($app->bootstrap as $bootstrap) {
            if (isset($app->$bootstrap) && $app->$bootstrap instanceof AddUrlRulesInterface) {
                $app->$bootstrap->addUrlRules();
            } elseif (class_exists($bootstrap)) {
                $cls = new $bootstrap;
                if ($cls instanceof AddUrlRulesInterface) {
                    $cls->addUrlRulesTo(\Yii::$app->urlManager);
                }
            }
        }
    }

}