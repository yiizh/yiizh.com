<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace libs\bootcdn;

use Yii;
use yii\base\BootstrapInterface;

class BootCDN implements BootstrapInterface
{
    /**
     * @return array
     */
    public function getAssetBootstraps()
    {
        return [
            BootstrapBootstrap::className(),
            JqueryBootstrap::className()
        ];
    }

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        foreach ($this->getAssetBootstraps() as $bootstrap) {
            $component = Yii::createObject($bootstrap);
            $component->bootstrap($app);
        }
    }
}