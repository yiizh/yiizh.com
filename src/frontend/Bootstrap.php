<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend;

use common\components\AddUrlRulesInterface;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface, AddUrlRulesInterface
{
    public function addUrlRulesTo($urlManager)
    {
        $urlManager->addRules([
            // 文件
            '/file/<id:\d+>/<name:\w+>.<extension:\w+>' => '/file/view',
            '/file/<id:\d+>/<name:\w+>' => '/file/view',
            //
            '/login' => '/site/login',
            '/logout' => '/site/logout',
            '/register' => '/site/register',
            '/' => '/site/index'
        ]);
    }

    public function bootstrap($app)
    {
    }

}