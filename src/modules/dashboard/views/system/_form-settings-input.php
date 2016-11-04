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
 * @var $models Settings[]
 */
?>
<?php $form = ActiveForm::begin(); ?>

<?php
foreach ($models as $index => $model) {
    echo $form->field($model, "[$index]value")->textInput()->label($model->name);
}
?>

<div class="form-group">
    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
