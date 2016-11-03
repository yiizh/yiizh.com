<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\QueueUrl;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QueueUrl */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '队列', 'url' => ['queue/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'URL 推送', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-url-view">

    <div class="box">
        <div class="box-body">

            <p>
                <?php if ($model->status == QueueUrl::STATUS_PENDING): ?>
                    <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
                <?= Html::a('删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '确认删除?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'url:url',
                    'statusLabel',
                    'pushDatetime',
                    'createdAt:datetime',
                    'updatedAt:datetime',
                ],
            ]) ?>

        </div>
    </div>
</div>
