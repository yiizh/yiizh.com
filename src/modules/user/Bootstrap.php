<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\user;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->setModule('user', [
            'class' => Module::className(),
        ]);

        $app->getUrlManager()->addRules([
            '/user/<userId:\d+>' => '/user/default/index',
        ]);
    }

}