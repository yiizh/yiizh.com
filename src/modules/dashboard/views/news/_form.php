<?php

use common\models\News;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yiizh\redactor\Redactor;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */

$projectIdInputId = Html::getInputId($model, 'projectId');
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->dropDownList(News::getTypeItems(), [
        'prompt' => '-- 请选择 --'
    ]) ?>

    <?= Html::activeHiddenInput($model, 'projectId') ?>
    <?= $form->field($model, 'projectName')->widget(AutoComplete::className(), [
        'options' => [
            'class' => 'form-control'
        ],
        'clientOptions' => [
            'source' => Url::to(['/project/project/search']),
            'select' => new JsExpression(<<<JS
function ( event, ui ){
    $('#{$projectIdInputId}').val(ui.item.id);
}
JS
            ),
        ]
    ]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(Redactor::className(), [

    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(News::getStatusItems()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
