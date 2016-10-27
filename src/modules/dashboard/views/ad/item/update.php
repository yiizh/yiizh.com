<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

/* @var $this yii\web\View */
/* @var $model common\models\AdPositionItem */

$this->title = 'Update Ad Position Item: ' . $model->positionId;
$this->params['breadcrumbs'][] = ['label' => 'Ad Position Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->positionId, 'url' => ['view', 'positionId' => $model->positionId, 'adId' => $model->adId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ad-position-item-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
