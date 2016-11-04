<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace libs\bootcdn;

use yii\base\BootstrapInterface;
use yii\base\Object;

abstract class BaseBootstrap extends Object implements BootstrapInterface
{
    public $baseUrl = 'http://cdn.bootcss.com';

    /**
     * @return array
     */
    abstract public function getAssetOptions();

    public function bootstrap($app)
    {
        foreach ($this->getAssetOptions() as $class => $options) {
            \Yii::$container->set($class, $options);
        }
    }
}