<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\assets\HighlightAsset;
use common\widgets\JsBlock;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 */

$this->title = '文章';

$this->registerMetaTag([
    'name' => 'description',
    'content' => '面向php开发者, yii开发者的中文文档、教程、技巧、下载及分享。'
]);

$keywords = [
    'yii2中文文档',
    'yii2中文教程',
    'yii2中文学习手册',
    'yii2分享',
    Yii::$app->name
];
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => implode(', ', $keywords)
]);

$this->params['breadcrumbs'][] = '文章';

HighlightAsset::register($this);
?>
<?php JsBlock::begin() ?>
<script>
    hljs.initHighlightingOnLoad();
</script>
<?php JsBlock::end() ?>
<div class="post-index">
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => ['tag' => false],
                        'layout' => '{items} {pager}',
                        'itemView' => '_view',
                        'separator' => '<hr />',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

</div>
