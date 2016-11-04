<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */
use common\assets\clipboard\ClipboardAsset;
use common\models\File;
use common\widgets\Alert;
use common\widgets\JsBlock;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;


/**
 * @var $this View
 * @var $model File
 * @var $file File
 */

$this->title = '上传文件';
$this->params['breadcrumbs'][] = ['label' => '文件', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

ClipboardAsset::register($this);
?>
<?php JsBlock::begin() ?>
<script>
    var clipboard = new Clipboard('.copy');
    clipboard.on('success', function (e) {
        var $this = $(e.trigger);
        $this.tooltip('show');
        setTimeout(function () {
            $this.tooltip('hide');
        }, 500);
    });
</script>
<?php JsBlock::end() ?>
<style>
    .well {
        word-break: break-all;
    }
</style>
<div class="container-fluid">
    <div class="file-upload-widget">
        <div class="page-header">
            <h1>上传文件</h1>
        </div>

        <?= Alert::widget() ?>

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

        <?php if ($file): ?>
            <h4>文件地址</h4>
            <div class="well well-sm" id="file-url">
                <?= $file->getUrl(true) ?>
            </div>
            <?= Html::button('复制', [
            'class' => 'btn btn-sm btn-default copy',
            'title' => '已复制!',
            'data' => [
                'trigger' => 'manual',
                'clipboard-action' => 'copy',
                'clipboard-target' => '#file-url'
            ]
        ]) ?>
            <h4>Markdown 内容</h4>
            <div class="well well-sm" id="file-markdown">
                <?php if ($file->getIsImage()): ?>
                    ![<?= $file->name ?>](<?= $file->getUrl(true) ?> "<?= $file->name ?>")
                <?php else: ?>
                    [<?= $file->name ?>](<?= $file->getUrl(true) ?> "<?= $file->name ?>")
                <?php endif; ?>
            </div>
            <?= Html::button('复制', [
                'class' => 'btn btn-sm btn-default copy',
                'title' => '已复制!',
                'data' => [
                    'trigger' => 'manual',
                    'clipboard-action' => 'copy',
                    'clipboard-target' => '#file-markdown'
                ]
            ]) ?>
        <?php endif; ?>
    </div>
</div>
