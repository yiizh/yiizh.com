<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 */

$this->title = '开源项目';

$this->params['breadcrumbs'][] = '开源项目';

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'yii2开源, 开源网站, 开源项目, 基于Yii2的开源项目, yii2 cms, yii2 cart, yii2 shop, yii2 forum'
]);

$this->registerMetaTag([
    'name' => 'description',
    'content' => '分享基于yii2的开源项目。'
]);
?>
<div class="project-index">
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'layout' => '{items} {pager}',
                        'itemView' => '_view',
                        'separator' => '<hr />',
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-xs hidden-sm">
            <div class="box">
                <div class="box-body">
                    广告位
                </div>
            </div>
        </div>
    </div>
</div>
