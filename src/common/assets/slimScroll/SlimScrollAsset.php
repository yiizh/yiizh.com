<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\assets\slimScroll;


use yii\web\AssetBundle;

class SlimScrollAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/slimscroll';

    public $js = [
        'jquery.slimscroll.min.js'
    ];
}