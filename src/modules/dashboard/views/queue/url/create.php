<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */


/* @var $this yii\web\View */
/* @var $model common\models\QueueUrl */

$this->title = '新增 URL 推送';
$this->params['breadcrumbs'][] = ['label' => '队列', 'url' => ['queue/default/index']];
$this->params['breadcrumbs'][] = ['label' => 'URL 推送', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-url-create">

    <div class="box">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
