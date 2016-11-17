<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\news\widgets;

use common\models\News;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class NewsList extends Widget
{
    /**
     * @var string|array
     */
    public $title;

    /**
     * @var News[]
     */
    public $models;

    /**
     * @var array
     */
    public $options = [];

    public function init()
    {
        parent::init();
        if ($this->models == null) {
            throw new InvalidConfigException('请配置 "models".');
        }

        Html::addCssClass($this->options['class'], 'panel panel-default news-list');
    }

    public function run()
    {
        return $this->render('news-list', [
            'title' => $this->renderTitle(),
            'models' => $this->models,
            'options' => $this->options
        ]);
    }

    /**
     * @return string
     */
    public function renderTitle()
    {
        if (is_array($this->title)) {
            return Html::a($this->title['label'], $this->title['url'], ArrayHelper::getValue($this->title, 'options'));
        } elseif (is_string($this->title)) {
            return $this->title;
        }
    }
}