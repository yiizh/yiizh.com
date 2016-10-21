<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use frontend\forms\RegisterForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var RegisterForm $model
 */
$this->title = '注册';
?>
<div class="site-register">
    <div class="row">
        <div class="col-sm-6 col-md-offset-3">
            <div class="box">
                <div class="box-body">
                    <div class="page-header">
                        <h1><?= $this->title ?></h1>
                    </div>
                    <?php $form = ActiveForm::begin(['id' => 'form-register']); ?>

                    <?= $form->field($model, 'name') ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'button-register']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
