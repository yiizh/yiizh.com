<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\post;


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
            '/post/<id:\d+>/<slug:[\w-]+>' => '/post/post/view',
            '/post' => '/post/post/index',
        ]);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $app->setModule('post', [
            'class' => Module::className()
        ]);
    }

}