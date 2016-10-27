<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Ad */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '广告', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-view">

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

            <?= DetailView::widget([
                'model' => $model,
                'template'=>'<tr><th width="100" {captionOptions}>{label}</th><td{contentOptions}>{value}</td></tr>',
                'attributes' => [
                    'id',
                    'name',
                    'content:ntext',
                    'createdAt:datetime',
                    'updatedAt:datetime',
                ],
            ]) ?>
        </div>
    </div>

</div>
