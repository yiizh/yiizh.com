<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\ContentPool;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ContentPool */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '内容池', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-pool-view">

    <div class="box">
        <div class="box-body">

            <p>
                <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '确定删除?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <p>
                <?php if ($model->status == ContentPool::STATUS_TODO): ?>
                    <?= Html::a('忽略', ['update', 'status' => ContentPool::STATUS_IGNORE, 'id' => $model->id], [
                        'class' => 'btn btn-default',
                        'data' => [
                            'confirm' => '确定忽略?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('已处理', ['update', 'status' => ContentPool::STATUS_PUBLISHED, 'id' => $model->id], [
                        'class' => 'btn btn-success',
                        'data' => [
                            'confirm' => '确定标记为已处理?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>

            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'url:url',
                    'title',
                    'from',
                    'statusLabel',
                    'createdAt:datetime',
                    'updatedAt:datetime',
                ],
            ]) ?>

            <div>
                <h1><?= $model->title ?></h1>
                <?= $model->description ?>
            </div>
        </div>
    </div>
</div>