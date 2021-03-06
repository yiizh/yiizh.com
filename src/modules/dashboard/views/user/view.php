<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="box">
        <div class="box-body">

            <p>
                <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php if ($model->getIsDeleted()): ?>
                    <?= Html::a('恢复', ['restore', 'id' => $model->id], [
                        'class' => 'btn btn-success',
                        'data' => [
                            'confirm' => '确认恢复?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php else: ?>
                    <?= Html::a('删除', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '确认删除?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'template' => '<tr><th width="180" {captionOptions}>{label}</th><td{contentOptions}>{value}</td></tr>',
                'attributes' => [
                    'id',
                    'email:email',
                    'name',
                    'status',
                    'avatar:image',
                    'weibo',
                    'createdAt:datetime',
                    'updatedAt:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
