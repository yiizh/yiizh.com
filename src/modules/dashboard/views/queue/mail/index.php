<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '邮件队列';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-mail-index">

    <div class="box">
        <div class="box-body">

            <p>
                <?= Html::a('新增邮件队列', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'to',
                    'mailContent.subject',
                    'statusLabel',
                    'sendDatetime:datetime',
                    'createdAt:datetime',
                    'updatedAt:datetime',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}'
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
