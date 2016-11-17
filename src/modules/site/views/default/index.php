<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use common\models\Settings;
use modules\news\widgets\NewsList;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var $this View
 * @var $latestNews News[]
 * @var $latestProjectProvider ActiveDataProvider
 * @var $latestPostProvider ActiveDataProvider
 */

$this->params['pageTitle'] = 'Yii中文 - yii框架中文网站，分享和学习';
$formatter = Yii::$app->formatter;

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => Settings::get(Settings::SITE_KEYWORDS)
]);

$this->registerMetaTag([
    'name' => 'description',
    'content' => Settings::get(Settings::SITE_DESCRIPTION)
]);
?>
<style>
    .jumbotron {
        text-align: left;
        padding: 0 !important;
    }

    .jumbotron h1 {
        font-size: 32px;
        margin-bottom: 30px;
    }

    .jumbotron p {

    }

    .features .box {
        height: 180px;
    }

    .news-list > .list-group > .list-group-item {
        border-top: 1px dashed #DDD;
    }
</style>
<div class="site-default-index">
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-body">
                    <div class="jumbotron">
                        <h1>Yii - <span class="text-orange">快速</span>&nbsp;<span class="text-green">安全</span>&nbsp;<span
                                class="text-blue">专业</span>的PHP开发框架。</h1>
                        <p>Yii 是一款高性能、用于开发 WEB2.0 应用的 PHP 框架。</p>
                        <p>Yii 包含了丰富的功能: MVC、DAO/ActiveRecord、I18N/L10N、缓存、认证、RBAC、脚手架、测试等等。这些功能可以大大缩短开发时间。</p>
                    </div>
                </div>
            </div>
            <div class="row features">
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header no-border no-padding">
                            <h4 class="text-orange">快速</h4>
                        </div>
                        <div class="box-body">
                            <p>Yii 只加载您需要的功能。它具有强大的缓存支持。它明确的设计能与 AJAX 一起高效率的工作。</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header no-border no-padding">
                            <h4 class="text-green">安全</h4>
                        </div>
                        <div class="box-body">
                            <p>Yii 的标准是安全的。它包括了输入验证，输出过滤，SQL 注入和跨站点脚本的预防。</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header no-border no-padding">
                            <h4 class="text-blue">专业</h4>
                        </div>
                        <div class="box-body">
                            <p>Yii 可帮助您开发清洁和可重用的代码。它遵循了 MVC 模式，确保了清晰分离逻辑层和表示层。</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <?= NewsList::widget([
                'title' => [
                    'label' => '最新资讯',
                    'url' => ['/news/news/index'],
                ],
                'models' => $latestNews
            ]) ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <h4><?= Html::a('最新文章', ['/post/post/index']) ?></h4>
        </div>
        <div class="box-body">
            <?= ListView::widget([
                'dataProvider' => $latestPostProvider,
                'layout' => '{items}',
                'itemView' => '@modules/post/views/post/_view',
                'separator' => '<hr class="line line-dashed">'
            ]) ?>
        </div>
    </div>
</div>