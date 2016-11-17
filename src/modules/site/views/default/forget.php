<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use frontend\forms\PasswordResetRequestForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model PasswordResetRequestForm
 */
$this->title = '忘记密码';
?>
<div class="site-forget">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-body">
                    <div class="page-header">
                        <h1><?= $this->title ?></h1>
                    </div>

                    <p class="text-muted">请填写您注册时使用的邮箱，重置密码的链接将会发送到您的邮箱。</p>

                    <?php $form = ActiveForm::begin(['id' => 'form-forget']); ?>

                    <?= $form->field($model, 'email') ?>

                    <div class="form-group">
                        <?= Html::submitButton('发送', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
