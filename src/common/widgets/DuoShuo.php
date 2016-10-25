<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\widgets;


use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;

class DuoShuo extends Widget
{
    /**
     * @var string 文章在站点中的 ID
     */
    public $threadKey;

    /**
     * @var string 文章标题
     */
    public $title;

    /**
     * @var string 文章地址
     */
    public $url;

    public function init()
    {
        parent::init();
        if ($this->threadKey == null) {
            throw new InvalidConfigException('必须配置 "threadKey"。');
        }
        if ($this->title == null) {
            throw new InvalidConfigException('必须配置 "title"。');
        }

        if ($this->url == null) {
            throw new InvalidConfigException('必须配置 "url"。');
        }
    }

    public function run()
    {
        echo Html::tag('div', '', [
            'class' => 'ds-thread',
            'data' => [
                'thread-key' => $this->threadKey,
                'title' => $this->title,
                'url' => $this->url,
            ]
        ]);
        $this->getView()->registerJs(<<<JS
var duoshuoQuery = {short_name:"yiizh"};
(function() {
    var ds = document.createElement('script');
    ds.type = 'text/javascript';ds.async = true;
    ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
    ds.charset = 'UTF-8';
    (document.getElementsByTagName('head')[0] 
     || document.getElementsByTagName('body')[0]).appendChild(ds);
})();
JS
            , View::POS_END, static::className());


    }
}