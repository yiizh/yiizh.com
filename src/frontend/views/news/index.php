<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '资讯';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <div class="row">
        <div class="col-xs-9">
            <div class="box">
                <div class="box-body">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['class' => 'item'],
                        'layout' => '{items} {pager}',
                        'itemView' => '_view',
                        'separator' => '<hr />',
                    ]) ?>
                </div>
            </div>

        </div>
        <div class="col-xs-3">
            <div class="box">
                <div class="box-body">
                    <p>好文章，要分享。</p>
                    <p>
                        <?= Html::a('投稿', ['/news/suggest'], ['class' => 'btn btn-block btn-success']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
