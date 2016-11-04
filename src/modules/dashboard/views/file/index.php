<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\File;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文件';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-index">

    <div class="box">
        <div class="box-body">
            <p>
                <?= Html::a('上传文件', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'header' => '',
                        'format' => 'raw',
                        'value' => function (File $model, $key, $index, $grid) {
                            return $model->getShortPreview();
                        }
                    ],
                    'uploader.name',
                    'mimeType',
                    'size:shortSize',
                    'createdAt:datetime',
                    'updatedAt:datetime',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
