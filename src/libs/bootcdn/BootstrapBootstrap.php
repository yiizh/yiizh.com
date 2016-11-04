<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace libs\bootcdn;

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;

class BootstrapBootstrap extends BaseBootstrap
{
    public $version = '3.3.7';

    /**
     */
    public function getAssetOptions()
    {
        return [
            BootstrapAsset::className() => [
                'sourcePath' => null,
                'css' => [
                    "{$this->baseUrl}/bootstrap/{$this->version}/css/bootstrap.min.css"
                ]
            ],
            BootstrapPluginAsset::className() => [
                'sourcePath' => null,
                'js' => [
                    "{$this->baseUrl}/bootstrap/{$this->version}/js/bootstrap.min.js"
                ]
            ]
        ];
    }
}