<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Project;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '项目';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <div class="box">
        <div class="box-body">
            <p>
                <?= Html::a('添加项目', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'name',
                    'license',
                    'homepage:url',
                    // 'docUrl:url',
                    'viewCount',
                    'deleted',
                    // 'createdAt',
                    // 'updatedAt',

                    [
                        'class' => ActionColumn::className(),
                        'template' => '{view} {update} {delete} {restore}',
                        'buttons' => [
                            'delete' => function ($url, Project $model, $key) {
                                if (!$model->getIsDeleted()) {
                                    return Html::a('删除', $url, [
                                        'title' => 'Delete',
                                        'data-confirm' => '确认删除？',
                                        'data-method' => 'post',
                                        'class' => 'text-danger'
                                    ]);
                                }
                            },
                            'restore' => function ($url, Project $model, $key) {
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
