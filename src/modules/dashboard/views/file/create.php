<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\File */

$this->title = '上传文件';
$this->params['breadcrumbs'][] = ['label' => '文件', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <div class="box">
        <div class="box-body">

            <div class="file-form">

                <?php $form = ActiveForm::begin([
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'file')->fileInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('上传', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>

</div>
