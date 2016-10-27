<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

/* @var $this yii\web\View */
/* @var $model common\models\AdPositionItem */

$this->title = 'Create Ad Position Item';
$this->params['breadcrumbs'][] = ['label' => 'Ad Position Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-position-item-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
