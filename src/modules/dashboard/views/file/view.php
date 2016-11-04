<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\File */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '文件', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-view">

    <div class="box">
        <div class="box-body">

            <p>
                <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                'template'=>'<tr><th width="160"{captionOptions}>{label}</th><td{contentOptions}>{value}</td></tr>',
                'attributes' => [
                    'id',
                    [
                        'label' => '预览',
                        'format' => 'raw',
                        'value' => $model->getShortPreview()
                    ],
                    'uploaderId',
                    'name',
                    'path',
                    'mimeType',
                    'extension',
                    'size:shortSize',
                    'createdAt:datetime',
                    'updatedAt:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
