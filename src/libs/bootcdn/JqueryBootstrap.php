<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace libs\bootcdn;

use yii\web\JqueryAsset;

class JqueryBootstrap extends BaseBootstrap
{
    public $version = '2.2.4';

    /**
     * @inheritDoc
     */
    public function getAssetOptions()
    {
        return [
            JqueryAsset::className() => [
                'sourcePath' => null,
                'js' => [
                    "{$this->baseUrl}/jquery/{$this->version}/jquery.min.js"
                ]
            ],
        ];
    }

}