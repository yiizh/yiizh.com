<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\ContentPool;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '内容池';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-pool-index">

    <div class="box">
        <div class="box-body">
            <p>
                <?= Html::a('新增内容', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function (ContentPool $model, $key, $gridview) {
                            return Html::a($model->title, $model->url, ['target' => '_blank']);
                        }
                    ],
                    'from',
                    'statusLabel',
                    'createdAt:datetime',
                    'updatedAt:datetime',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>

    </div>
</div>