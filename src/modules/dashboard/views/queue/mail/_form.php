<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\MailContent;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yiizh\redactor\Redactor;

/**
 * @var $this yii\web\View
 * @var $model common\models\QueueMail
 * @var $form yii\widgets\ActiveForm
 * @var $mailContent MailContent
 */
?>

<div class="queue-mail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fromName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($mailContent, 'subject')->textInput() ?>

    <?= $form->field($mailContent, 'body')->widget(Redactor::className(), [

    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
