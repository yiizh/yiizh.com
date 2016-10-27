<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\AdPositionItem;
use common\widgets\JsBlock;
use yii\bootstrap\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\AdPosition
 * @var $adProvider ActiveDataProvider
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '广告位', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$m = new AdPositionItem();
$m->positionId = $model->id;
$adIdInputId = Html::getInputId($m, 'adId');
?>
<?php JsBlock::begin() ?>
<script>
    $(document).on('submit', '#form-add-ad', function () {
        if ($('#<?=$adIdInputId?>').val().trim() == '') {
            alert('请选择广告');
            return false;
        }
    });
</script>
<?php JsBlock::end() ?>
<div class="ad-position-view">

    <div class="box">
        <div class="box-body">
            <p>
                <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('删除', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '确定删除?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'template' => '<tr><th width="100" {captionOptions}>{label}</th><td{contentOptions}>{value}</td></tr>',
                'attributes' => [
                    'id',
                    'code',
                    'name',
                    'createdAt:datetime',
                    'updatedAt:datetime',
                ],
            ]) ?>

            <h3>广告</h3>

            <div class="row" style="margin-bottom: 15px;">
                <div class="col-md-6">
                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'form-add-ad',
                        'layout' => 'inline',
                        'action' => ['ad/item/create', 'positionId' => $model->id]
                    ]) ?>

                    <?= Html::activeHiddenInput($m, 'positionId') ?>
                    <?= Html::activeHiddenInput($m, 'adId') ?>

                    <?= $form->field($m, 'name')->widget(AutoComplete::className(), [
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => '搜索广告添加到此广告位'
                        ],
                        'clientOptions' => [
                            'source' => Url::to(['ad/ad/search']),
                            'select' => new JsExpression(<<<JS
function ( event, ui ){
    $('#{$adIdInputId}').val(ui.item.id);
}
JS
                            )
                        ]
                    ]) ?>

                    <?= Html::submitButton('添加', ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>

            <?= GridView::widget([
                'dataProvider' => $adProvider,
                'columns' => [
                    'ad.name',
                    'ad.content:raw',
                    'ad.createdAt:datetime',
                    'ad.updatedAt:datetime',
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{update} {delete}',
                        'controller' => 'ad/item',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('更新', $url, [
                                    'class' => 'btn btn-primary btn-sm',
                                    'data' => ['toggle' => 'ajax-modal']
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('删除', $url, [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data-confirm' => '确定删除？',
                                    'data-method' => 'post',
                                ]);
                            }
                        ]
                    ],
                ]
            ]) ?>
        </div>
    </div>
</div>
