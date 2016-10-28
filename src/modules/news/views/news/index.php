<?php

use common\models\News;
use yii\bootstrap\Tabs;
use yii\helpers\Html;
use yii\widgets\ListView;

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $type int
 * @var $typeValid bool
 */

$this->title = '资讯';
if (!$typeValid) {
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/news/news/index']];
    $this->params['breadcrumbs'][] = News::typeLabel($type);
}

?>
<div class="news-index">
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <?= Tabs::widget([
                        'renderTabContent' => false,
                        'items' => [
                            ['label' => '全部资讯', 'url' => ['/news/news/index'], 'active' => !$typeValid],
                            ['label' => '综合资讯', 'url' => ['/news/news/index', 'type' => News::TYPE_DEFAULT], 'active' => $type == News::TYPE_DEFAULT],
                            ['label' => '头条', 'url' => ['/news/news/index', 'type' => News::TYPE_HEADLINE], 'active' => $type == News::TYPE_HEADLINE],
                            ['label' => '项目更新资讯', 'url' => ['/news/news/index', 'type' => News::TYPE_PROJECT], 'active' => $type == News::TYPE_PROJECT],
                        ]
                    ]) ?>
                    <div class="tab-content" style="margin-top: 15px;">
                        <div class="tab-pane active">
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
            </div>
        </div>
        <div class="col-md-3 hidden-xs hidden-sm">
            <div class="box">
                <div class="box-body">
                    <p>好文章，要分享。</p>
                    <p>
                        <?= Html::a('立刻分享', ['suggest'], ['class' => 'btn btn-block btn-success']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
