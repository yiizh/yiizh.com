<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

/* @var $this yii\web\View */
/* @var $model common\models\Subscription */

$this->title = '更新订阅: ' . $model->channelTitle;
$this->params['breadcrumbs'][] = ['label' => '订阅', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->channelTitle, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="subscription-update">

    <div class="box">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
