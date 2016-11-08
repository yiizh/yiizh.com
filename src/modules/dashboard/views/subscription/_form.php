<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\widgets\JsBlock;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Subscription */
/* @var $form yii\widgets\ActiveForm */
$urlInputId = Html::getInputId($model, 'url');
$titleInputId = Html::getInputId($model, 'channelTitle');
$linkInputId = Html::getInputId($model, 'link');
$descriptionInputId = Html::getInputId($model, 'description');
$modifyDatetimeInputId = Html::getInputId($model, 'modifyDatetime');
?>
<?php JsBlock::begin() ?>
<script>
    $(document).on('click', '#load-subscription', function () {
        var $this = $(this);
        $.ajax({
            url: '<?=Url::to('channel')?>',
            data: {"url": $('#<?=$urlInputId?>').val()},
            beforeSend: function (request) {
                $this.addClass('disabled');
                $this.html('<i class="fa fa-spinner fa-spin"></i> 加载中...');
            },
            complete: function (request, textStatus) {
                $this.removeClass('disabled');
                $this.html('加载');
            },
            success: function (rs) {
                console.log(rs);
                $('#<?=$titleInputId?>').val(rs.title);
                $('#<?=$linkInputId?>').val(rs.link);
                $('#<?=$descriptionInputId?>').val(rs.description);
                $('#<?=$modifyDatetimeInputId?>').val(rs.modifyDatetime);
            },
            error: function (request, textStatus, errorThrown) {
                alert('Error Code: ' + textStatus);
            }
        });
    });
</script>
<?php JsBlock::end() ?>
<div class="subscription-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <p><?= Html::a('加载', 'javascript:void(0);', ['class' => 'btn btn-default', 'id' => 'load-subscription']) ?></p>

    <?= $form->field($model, 'channelTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modifyDatetime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
