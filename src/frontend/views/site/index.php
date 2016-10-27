<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use common\widgets\AdPositionWidget;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var $this View
 * @var $latestNewsProvider ActiveDataProvider
 * @var $latestProjectProvider ActiveDataProvider
 */

$this->params['pageTitle'] = 'Yii中文 - yii框架中文网站，分享和学习';
$formatter = Yii::$app->formatter;

$this->registerMetaTag([
    'name' => 'keywords',
    'value' => Settings::get(Settings::SITE_KEYWORDS)
]);

$this->registerMetaTag([
    'name' => 'description',
    'value' => Settings::get(Settings::SITE_DESCRIPTION)
]);
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <h4><?= Html::a('最新资讯', ['/news/news/index']) ?></h4>
                </div>
                <div class="box-body">
                    <?= ListView::widget([
                        'dataProvider' => $latestNewsProvider,
                        'layout' => '{items}',
                        'itemView' => '@modules/news/views/news/_view',
                        'separator' => '<hr class="line line-dashed">'
                    ]) ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    <h4><?= Html::a('最新收录', ['/project/project/index']) ?></h4>
                </div>
                <div class="box-body">
                    <?= ListView::widget([
                        'dataProvider' => $latestProjectProvider,
                        'layout' => '{items}',
                        'itemView' => '@modules/project/views/project/_view',
                        'separator' => '<hr class="line line-dashed">'
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
                    <?= AdPositionWidget::widget([
                        'code' => 'site-index-right-1'
                    ]) ?>

        </div>
    </div>
</div>