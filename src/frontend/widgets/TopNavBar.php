<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\widgets;


use common\models\Settings;
use Yii;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class TopNavBar extends BaseNavBar
{
    const EVENT_INIT = 'init';

    public $defaultPosition = 'left';
    public $options = [];
    public $navbarOptions = [];

    public function init()
    {
        parent::init();
        $this->trigger(self::EVENT_INIT);

        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        $settings = \Yii::$app->settings;

        $defaultOptions = [
            'brandLabel' => Html::img('@web/static/images/brand-logo.png', ['alt' => $settings->get(Settings::SITE_NAME)]),
            'brandUrl' => Yii::$app->homeUrl,
            'brandOptions' => [
                'title' => $settings->get(Settings::SITE_NAME)
            ],
            'options'=>$this->navbarOptions
        ];

        $this->options = ArrayHelper::merge($defaultOptions, $this->options);
    }

    public function run()
    {
        parent::run();
        ob_start();
        NavBar::begin($this->options);
        $leftItems = [];
        $rightItems = [];

        foreach ($this->getItems() as $key => $item) {
            if (ArrayHelper::getValue($item, 'position', $this->defaultPosition) == 'left') {
                $leftItems[$key] = $item;
            } elseif (ArrayHelper::getValue($item, 'position', $this->defaultPosition) == 'right') {
                $rightItems[$key] = $item;
            }
        }

        echo Nav::widget([
            'encodeLabels' => false,
            'options' => [
                'class' => 'navbar-nav navbar-left'
            ],
            'items' => $leftItems
        ]);

        echo Nav::widget([
            'encodeLabels' => false,
            'options' => [
                'class' => 'navbar-nav navbar-right'
            ],
            'items' => $rightItems
        ]);

        NavBar::end();
        return ob_get_clean();
    }

    public function addItem($item, $to = null)
    {
        if (!isset($item['position'])) {
            $item['position'] = $this->defaultPosition;
        }
        parent::addItem($item, $to);
    }
}