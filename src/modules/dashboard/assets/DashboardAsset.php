<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\assets;

use yii\web\AssetBundle;

class DashboardAsset extends AssetBundle
{
    public $sourcePath = '@modules/dashboard/assets/dist';
    public $css = [
        'css/dashboard.css'
    ];
    public $js = [
        'js/dashboard.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'common\assets\slimScroll\SlimScrollAsset',
        'yiizh\adminlte\AdminLTEAsset',
        'yiizh\adminlte\AdminLTEBlueAsset',
        'yiizh\fontawesome\FontAwesomeAsset'
    ];

    public function init()
    {
        parent::init();
        if (getenv('APP_ENV') == 'dev') {
            $this->publishOptions['forceCopy'] = true;
        }
    }
}