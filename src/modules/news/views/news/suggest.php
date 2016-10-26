<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;
use yiizh\redactor\Redactor;

/**
 * @var $this View
 * @var $model News
 */

$this->title = '分享';

$this->params['breadcrumbs'][] = ['label' => '资讯', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-suggest">
    <div class="box">
        <div class="box-body">
            <?php $form = ActiveForm::begin(['id' => 'news-add']) ?>

            <?= $form->field($model, 'link') ?>

            <?= $form->field($model, 'title') ?>

            <?= $form->field($model, 'summary')->widget(Redactor::className(), [

            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
