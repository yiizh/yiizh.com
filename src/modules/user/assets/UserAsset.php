<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\user\assets;


use yii\web\AssetBundle;

class UserAsset extends AssetBundle
{
    public $sourcePath = '@modules/user/assets/dist';

    public $css = [
        'css/user.css'
    ];

    public function init()
    {
        parent::init();
        if(getenv('APP_ENV') == 'dev'){
            $this->publishOptions['forceCopy'] = true;
        }
    }
}