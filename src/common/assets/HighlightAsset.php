<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\assets;

use yii\web\AssetBundle;

class HighlightAsset extends AssetBundle
{
    public $baseUrl = 'http://cdn.bootcss.com/highlight.js/9.7.0';
    public $js = [
        'highlight.min.js',
        'languages/php.min.js',
        'languages/javascript.min.js',
        'languages/bash.min.js',
        'languages/css.min.js',
    ];
    public $css = [
        'styles/zenburn.min.css'
    ];
}