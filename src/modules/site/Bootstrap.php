<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\site;

use common\components\AddUrlRulesInterface;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface, AddUrlRulesInterface
{
    /**
     * @inheritDoc
     */
    public function addUrlRulesTo($urlManager)
    {
        $urlManager->addRules([
            '/login' => '/site/default/login',
            '/logout' => '/site/default/logout',
            '/register' => '/site/default/register',
            '/' => '/site/default/index'
        ]);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $app->setModule('site', [
            'class' => Module::className()
        ]);
    }

}