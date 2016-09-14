<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\widgets;


use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

class ManageBar extends BaseNavBar
{
    const EVENT_INIT = 'init';

    public function init()
    {
        parent::init();
        $this->trigger(self::EVENT_INIT);
    }

    public function run()
    {
        ob_start();
        parent::run();
        NavBar::begin([
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);
        echo Nav::widget([
            'options' => [
                'class' => 'navbar-nav navbar-left'
            ],
            'items' => $this->getItems()
        ]);
        NavBar::end();
        return ob_get_clean();
    }

}