<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\bootstrap\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = '订阅';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-index">

    <div class="box">
        <div class="box-body">
            <p>
                <?= Html::a('新增订阅', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'channelTitle',
                    'link',
                    'description',
                    'modifyDatetime:datetime',
                    'lastUpdatedAt:datetime',
                    // 'createdAt',
                    // 'updatedAt',

                    [
                        'class' => ActionColumn::className(),
                        'template' => '{reader} {view} {update} {delete}',
                        'buttons' => [
                            'reader' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-rss fa-fw"></i> 阅读器', $url, ['class' => 'btn btn-sm btn-default']);
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>