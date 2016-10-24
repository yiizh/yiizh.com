<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use frontend\forms\ChangePasswordForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $model ChangePasswordForm
 */

$this->title = '修改密码';
?>
<div class="account-change-password">
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <?php $form = ActiveForm::begin([
                        'id' => 'form-change-password'
                    ]) ?>

                    <?= $form->field($model, 'oldPassword')->passwordInput() ?>

                    <?= $form->field($model, 'newPassword')->passwordInput() ?>

                    <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('修改密码', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end() ?>
                </div>
            </div>

        </div>
    </div>
</div>
