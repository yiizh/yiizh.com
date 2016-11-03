<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

/* @var $this yii\web\View */
/* @var $model common\models\QueueUrl */

$this->title = 'Update Queue Url: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '队列', 'url' => ['queue/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Queue Urls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="queue-url-update">

    <div class="box">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
