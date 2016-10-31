<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Post;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <div class="box">
        <div class="box-body">
            <p>
                <?= Html::a('新增文章', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'author.name',
                    'title',
                    'slug',
                    'typeLabel',
                    // 'originalUrl:url',
                    // 'content:ntext',
                     'viewCount',
                     'deleted',
                     'publishStatusLabel',
                    // 'publishDatetime',
                    // 'createdAt',
                    // 'updatedAt',

                    [
                        'class' => ActionColumn::className(),
                        'template' => '{view} {update} {delete} {restore}',
                        'buttons' => [
                            'delete' => function ($url, Post $model, $key) {
                                if (!$model->getIsDeleted()) {
                                    return Html::a('删除', $url, [
                                        'title' => 'Delete',
                                        'data-confirm' => '确认删除？',
                                        'data-method' => 'post',
                                        'class' => 'text-danger'
                                    ]);
                                }
                            },
                            'restore' => function ($url, Post $model, $key) {
                                if ($model->getIsDeleted()) {
                                    return Html::a('恢复', $url, [
                                        'title' => '恢复',
                                        'data-confirm' => '确认恢复？',
                                        'data-method' => 'post',
                                        'class' => 'text-success'
                                    ]);
                                }
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
