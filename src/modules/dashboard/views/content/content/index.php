<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\ContentPool;
use common\widgets\JsBlock;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '内容池';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php JsBlock::begin() ?>
<script>
    $(document).on('click', '.js-ajax-post', function (e) {
        e.preventDefault();
        var $this = $(this);
        var url = $this.attr('href');
        var successText = $this.attr('data-successtext') == undefined ? '成功' : $this.attr('data-successtext');
        var successClass = $this.attr('data-successclass') == undefined ? '成功' : $this.attr('data-successclass');
        $.ajax({
            url: url,
            method: 'post',
            dataType: 'json',
            beforeSend: function () {
                $this.html('<i class="fa fa-spinner fa-spin"></i> 正在提交...');
                $this.addClass('disabled');
            },
            complete: function () {
            },
            success: function (rs) {
                if (rs.success) {
                    $this.html(successText);
                    $this.removeClass('btn-default');
                    $this.addClass(successClass);
                    $this.parent().html($this);
                } else {
                    $this.html(rs.errorMessage);
                }
            },
            error: function () {
                $this.html('提交失败');
            }
        });
    });
</script>
<?php JsBlock::end() ?>
<div class="content-pool-index">

    <div class="box">
        <div class="box-body">
            <p>
                <?= Html::a('新增内容', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function (ContentPool $model, $key, $gridview) {
                            return Html::a($model->title, $model->url, ['target' => '_blank']);
                        }
                    ],
                    'from',
                    [
                        'header' => '状态',
                        'class' => ActionColumn::className(),
                        'template' => '{label} {ignore} {published}',
                        'headerOptions' => ['style' => 'width:160px;'],
                        'buttons' => [
                            'label' => function ($url, ContentPool $model, $key) {
                                if ($model->status == ContentPool::STATUS_IGNORE) {
                                    return Html::a('已忽略', 'javascript: void(0);', ['class' => 'btn btn-sm btn-default disabled']);
                                }

                                if ($model->status == ContentPool::STATUS_PUBLISHED) {
                                    return Html::a('已发布', 'javascript: void(0);', ['class' => 'btn btn-sm btn-success disabled']);
                                }
                            },
                            'ignore' => function ($url, ContentPool $model, $key) {
                                if ($model->status == ContentPool::STATUS_TODO) {
                                    return Html::a('忽略', ['update', 'id' => $model->id, 'status' => ContentPool::STATUS_IGNORE], ['class' => 'btn btn-sm btn-default js-ajax-post', 'data' => [
                                        'successText' => '已忽略',
                                        'successClass' => 'btn-default',
                                    ]]);
                                }
                            },
                            'published' => function ($url, ContentPool $model, $key) {
                                if ($model->status == ContentPool::STATUS_TODO) {
                                    return Html::a('已处理', ['update', 'id' => $model->id, 'status' => ContentPool::STATUS_PUBLISHED], ['class' => 'btn btn-sm btn-default js-ajax-post', 'data' => [
                                        'successText' => '已发布',
                                        'successClass' => 'btn-success',
                                    ]]);
                                }
                            }
                        ]
                    ],
                    'publishDatetime:datetime',
                    [
                        'class' => ActionColumn::className(),
                        'headerOptions' => ['style' => 'width:80px;'],
                    ],
                ],
            ]); ?>
        </div>

    </div>
</div>