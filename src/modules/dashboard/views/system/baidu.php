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

$this->title = '百度';
?>
<div class="manage-system-baidu">
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
                    'rows' => 2
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
