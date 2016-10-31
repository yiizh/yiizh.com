<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $settings Settings[]
 */

$this->title = 'End Body 代码块';
?>
<div class="manage-system-block-end-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= $this->title ?>
            </h4>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <?php
            foreach ($settings as $index => $setting) {
                echo $form->field($setting, "[$index]value")->textarea([
                    'rows' => 30
                ])->label($setting->name);
            }
            ?>

            <div class="form-group">
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
