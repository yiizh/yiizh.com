<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\assets\HighlightAsset;
use common\models\Post;
use common\widgets\DuoShuo;
use common\widgets\JsBlock;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Json;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var $this View
 * @var $model Post
 */

$this->title = $model->title . '_文章';
$author = $model->author;
$formatter = Yii::$app->formatter;

$this->registerMetaTag([
    'name' => 'description',
    'content' => StringHelper::truncate($model->getPureContent(), 200)
]);

$keywords = [
    $model->title,
    $author->name,
    Yii::$app->name
];
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => implode(', ', $keywords)
]);

$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
HighlightAsset::register($this);
?>
<?php JsBlock::begin() ?>
<script>
    hljs.initHighlightingOnLoad();
    window._bd_share_config = {
        "common": {
            "bdSnsKey": {},
            "bdUrl": "<?=$model->getUrl(true)?>",
            "bdText": "<?=$model->title?>",
            "bdMini": "2",
            "bdMiniList": false,
            "bdPic": "",
            "bdStyle": "0",
            "bdSize": "16"
        }, "share": {}
    };
</script>
<?php JsBlock::end() ?>
<div class="post-view">
    <div class="row">
        <div class="col-md-9">
            <div class="box">
                <div class="box-body">
                    <article class="post">
                        <h1 class="post-title"><?= $model->title ?></h1>
                        <p class="post-meta">
                            <time><?= $formatter->asRelativeTime($model->publishDatetime) ?></time>
                            <a class="visible-xs-inline visible-sm-inline"
                               href="<?= $author->getUrl() ?>">@<?= $author->name ?></a>
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
                        <div class="post-content highlight">
                            <?= HtmlPurifier::process($model->contentHtml) ?>
                        </div>
                        <?php if ($model->type == Post::TYPE_ORIGINAL): ?>
                            <div class="post-copyright">
                                本站文章除注明转载外，均为本站原创或编译<br/>
                                欢迎任何形式的转载，但请务必注明出处，尊重他人劳动成果<br/>
                                转载请注明：文章转载自：Yii中文 [<?= Html::a(Url::to('/', true), Url::to('/', true)) ?>]<br/>
                                本文标题：<?= $model->title ?><br/>
                                本文地址：<?= Html::a($model->getUrl(true), $model->getUrl(true)) ?>
                            </div>
                        <?php elseif ($model->type == Post::TYPE_REPOST): ?>
                            <div class="post-repost">
                                原文地址: <?= Html::a($model->originalUrl, $model->originalUrl, ['target' => '_blank']) ?>
                            </div>
                        <?php endif; ?>
                        <hr>
                        <?= DuoShuo::widget([
                            'threadKey' => Json::encode(['env' => getenv('APP_ENV'), 'type' => 'post', 'id' => $model->id]),
                            'title' => $model->title,
                            'url' => $model->getUrl(true)
                        ]) ?>
                    </article>
                </div>
            </div>
        </div>
        <div class="col-md-3 hidden-xs hidden-sm">
        </div>
    </div>
</div>
