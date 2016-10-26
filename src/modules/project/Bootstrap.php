<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\project;


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
            '/project/<id:\d+>' => '/project/project/view',
            '/project' => '/project/project/index',
        ]);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $app->setModule('project', [
            'class' => Module::className()
        ]);
    }

}