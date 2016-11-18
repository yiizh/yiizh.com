<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\assets\TagManager\TagManagerAsset;
use common\models\Post;
use common\widgets\JsBlock;
use kartik\datetime\DateTimePicker;
use kartik\markdown\MarkdownEditor;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */

$titleInputId = Html::getInputId($model, 'title');
$slugInputId = Html::getInputId($model, 'slug');
$tagsInputId = Html::getInputId($model, 'tags');
$tagsInputName = Html::getInputName($model, 'tags');

$slugUrl = Url::to(['slug/index']);

$this->params['rightBar'] = [
    'src' => Url::to(['file/upload-widget'])
];


TagManagerAsset::register($this);
?>
<?php JsBlock::begin() ?>
<script>
    $(document).on('blur', '#<?=$titleInputId?>, #<?=$slugInputId?>', function () {
        var $title = $('#<?=$titleInputId?>');
        var $slug = $('#<?=$slugInputId?>');
        if ($slug.val().trim().length == 0) {
            $.getJSON('<?=$slugUrl?>', {string: $title.val()}, function (rs) {
                $slug.val(rs.slug);
            });
        }
    });
    $('#<?=$tagsInputId?>').tagsManager({
        prefilled: <?=Json::encode($model->tags)?>,
        hiddenTagListName: '<?=$tagsInputName?>'
    });
</script>
<?php JsBlock::end() ?>
<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput([
        'maxlength' => true
    ]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(Post::getTypeItems()) ?>

    <?= $form->field($model, 'originalUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publishStatus')->dropDownList(Post::getPublishStatusItems()) ?>

    <?= $form->field($model, 'publishDatetime')->widget(DateTimePicker::className(), [
        'pluginOptions' => [
            'format' => 'yyyy-m-d hh:ii:ss',
            'todayBtn' => true
        ]
    ]) ?>

    <?= $form->field($model, 'contentMarkdown')->widget(MarkdownEditor::className(), [

    ]) ?>

    <div class="form-group">
        <?= Html::activeLabel($model, 'tags', ['class' => 'control-label']) ?>
        <div>
            <?= Html::textInput('', '', ['placeholder' => '标签, 点击回车或逗号添加', 'id' => $tagsInputId, 'class' => 'form-control']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
