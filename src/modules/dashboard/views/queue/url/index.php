<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\QueueUrl;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'URL 推送';

$this->params['breadcrumbs'][] = ['label' => '队列', 'url' => ['queue/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-url-index">

    <div class="box">
        <div class="box-body">
            <p>
                <?= Html::a('新增 URL 推送', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'url:url',
                    'statusLabel',
                    'pushDatetime',
                    'createdAt:datetime',
                    'updatedAt:datetime',

                    [
                        'class' => ActionColumn::className(),
                        'buttons'=>[
                            'update'=>function($url, QueueUrl $model, $key){
                                if($model->status == QueueUrl::STATUS_PENDING){
                                    return Html::a('更新',$url);
                                }
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
