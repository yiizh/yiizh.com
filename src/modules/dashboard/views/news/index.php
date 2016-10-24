<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var View $this
 * @var int $status
 * @var ActiveDataProvider $dataProvider
 */

$this->title = News::statusLabel($status) ;
?>
<div class="manage-news-index">
    <div class="box">
        <div class="box-body">
            <p>
                <?= Html::a('添加新闻', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '{items}{pager}',
                'itemOptions' => ['class' => 'item'],
                'itemView' => '_view',
                'separator' => '<hr />',
            ]) ?>

        </div>
    </div>
</div>
