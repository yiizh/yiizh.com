<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\assets\clipboard;

use yii\web\AssetBundle;

class ClipboardAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/clipboard/dist';

    public $js = [
        'clipboard.min.js'
    ];
}