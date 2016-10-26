<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\account;

use common\components\AddUrlRulesInterface;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface, AddUrlRulesInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->setModule('account', [
            'class' => Module::className(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function addUrlRulesTo($urlManager)
    {
        $urlManager->addRules([
            '/account/<controller:[\w-]+/<action:[\w-]+>' => '/account/<controller>/<action>',
            '/account/<controller:[\w-]+>' => '/account/<controller>/index',
        ]);
    }
}