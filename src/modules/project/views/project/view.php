<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Project;
use common\widgets\DuoShuo;
use common\widgets\JsBlock;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Json;
use yii\helpers\StringHelper;
use yii\web\View;

/**
 * @var $this View
 * @var $model Project
 */

$this->title = $model->name . '首页和文档_开源项目';
$formatter = Yii::$app->formatter;

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => implode(', ', [
        $model->name,
        $model->name . '是什么',
        $model->name . '文档',
        $model->name . '汉化',
        $model->name . '下载',
        $model->name . '社区',
        $model->name . '论坛',
    ])
]);

$this->registerMetaTag([
    'name' => 'description',
    'content' => strip_tags(StringHelper::truncateWords($model->description, 1, '...', true)),
]);


$this->params['breadcrumbs'][] = ['label' => '开源项目', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<?php JsBlock::begin() ?>
<script>
    window._bd_share_config = {
        "common": {
            "bdSnsKey": {},
            "bdUrl": "<?=$model->getUrl(true)?>",
            "bdText": "<?=$model->name?>",
            "bdMini": "2",
            "bdMiniList": false,
            "bdPic": "",
            "bdStyle": "0",
            "bdSize": "16"
        }, "share": {}
    };
</script>
<?php JsBlock::end() ?>
<div class="project-view">
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <div class="project">
                        <h1 class="project-title"><?= $model->name ?></h1>
                        <p class="project-meta">
                            <time><?= $formatter->asRelativeTime($model->createdAt) ?></time>
                        </p>
                        <div>
                            <div class="bdsharebuttonbox">
                                <a href="#" class="bds_more" data-cmd="more"></a>
                                <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                                <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                                <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                                <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                                <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                            </div>
                        </div>
                        <div class="project-description"><?= HtmlPurifier::process($model->description) ?></div>
                        <div class="project-attributes">
                            <dl class="dl-horizontal">
                                <dt>授权协议</dt>
                                <dd><?= $model->license ?></dd>
                                <dt>收录时间</dt>
                                <dd><?= $formatter->asDate($model->createdAt) ?></dd>
                            </dl>
                        </div>
                        <p>
                            <?= Html::a('项目首页', $model->homepage, ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
                            <?= Html::a('项目文档', $model->docUrl, ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
                        </p>
                    </div>
                    <hr>
                    <?= DuoShuo::widget([
                        'threadKey' => Json::encode(['env' => getenv('APP_ENV'), 'type' => 'project', 'id' => $model->id]),
                        'title' => $model->name,
                        'url' => $model->getUrl(true)
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-xs hidden-sm">
            <div class="box">
                <div class="box-body">
                    广告位
                </div>
            </div>
        </div>
    </div>
</div>
