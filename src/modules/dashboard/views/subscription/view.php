<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Subscription */

$this->title = $model->channelTitle;
$this->params['breadcrumbs'][] = ['label' => '订阅', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-view">

    <div class="box">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-rss fa-fw"></i> 阅读器', ['reader', 'id' => $model->id], ['class' => 'btn btn-default']); ?>
                <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '确定删除?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'url:url',
                    'channelTitle',
                    'link',
                    'description',
                    'modifyDatetime:datetime',
                    'lastUpdatedAt:datetime',
                    'createdAt:datetime',
                    'updatedAt:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
