<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use common\models\User;
use common\widgets\JsBlock;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\StringHelper;
use yii\web\View;

/**
 * @var $this View
 * @var $model News
 * @var $user User
 */

$this->title = $model->title;
$user = $model->user;
$formatter = Yii::$app->formatter;

$this->registerMetaTag([
    'name' => 'description',
    'content' => StringHelper::truncate(strip_tags($model->summary), 200)
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $model->title
]);

$this->params['breadcrumbs'][] = ['label' => '资讯', 'url' => ['/news/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php JsBlock::begin() ?>
<script>
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
<div class="news-view">
    <div class="row">
        <div class="col-xs-9">
            <div class="box">
                <div class="box-body">
                    <div class="row news-item">
                        <div class="col-xs-2 text-right">
                            <p>
                                <a href="<?= $user->getUrl() ?>"><img src="<?= $user->getAvatarUrl() ?>"
                                                                      class="img-thumbnail"></a>
                            </p>
                            <p class="news-item-info text-center">
                                <a href="<?= $user->getUrl() ?>">@<?= $user->name ?></a>
                            </p>
                        </div>
                        <div class="col-xs-10">
                            <h3 class="news-item-title"><?= $model->title ?></h3>
                            <p class="news-item-meta">
                                <time class="text-muted"><?= $formatter->asRelativeTime($model->createdAt) ?></time>
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
                            <p class="news-item-summary"><?= HtmlPurifier::process($model->summary) ?></p>
                            <p><?= Html::a($model->link, $model->link, ['target' => '_blank']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="box">
                <div class="box-body">
                    <p>好文章，要分享。</p>
                    <p>
                        <?= Html::a('推荐文章', ['/news/suggest'], ['class' => 'btn btn-block btn-success']) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
