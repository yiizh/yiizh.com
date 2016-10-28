<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\news;

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
            '/news/<id:\d+>' => '/news/news/view',
            '/news/suggest' => '/news/news/suggest',
            '/news/headline' => '/news/news/headline',
            '/news' => '/news/news/index',
        ]);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $app->setModule('news', [
            'class' => Module::className()
        ]);
    }

}