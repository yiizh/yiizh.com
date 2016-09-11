<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use frontend\forms\ResetPasswordForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model ResetPasswordForm
 */

$this->title = '重置密码';
?>
<div class="site-reset-password">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="page-header">
                <h1><?= $this->title ?></h1>
            </div>
            <p class="text-muted">请输入新的密码:</p>

            <?php $form = ActiveForm::begin(['id' => 'form-reset-password']); ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('修改密码', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
