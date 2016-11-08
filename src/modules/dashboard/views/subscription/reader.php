<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Subscription;
use yii\data\ArrayDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var $this View
 * @var $model Subscription
 * @var $itemProvider ArrayDataProvider
 */

$this->title = '阅读器';
$this->params['breadcrumbs'][] = ['label' => '订阅', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->channelTitle, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '阅读器';
?>
<div class="subscription-reader">
    <div class="box">
        <div class="box-header">
            <h4><?= $model->channelTitle ?></h4>
        </div>
        <div class="box-body">
            <p>
                <i class="fa fa-rss fa-fw"></i> <?= $model->url ?>
            </p>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <?= ListView::widget([
                'dataProvider' => $itemProvider,
                'itemView' => '_view-item',
                'separator' => '<hr />'
            ]) ?>
        </div>
    </div>
</div>
