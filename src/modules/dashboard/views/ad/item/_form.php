<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdPositionItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-position-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?=Html::activeLabel($model,'positionId')?>

        <p><?=$model->position->name?></p>
    </div>

    <?= $form->field($model, 'adId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
