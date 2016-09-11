<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use common\models\User;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\View;

/**
 * @var $this View
 * @var $model News
 * @var $user User
 */
$user = $model->user;
$formatter = Yii::$app->formatter;
?>
<div class="row news-item">
    <div class="col-xs-2 text-right">
        <p>
            <img src="<?= $user->getAvatarUrl() ?>" class="img-thumbnail">
        </p>
        <p class="news-item-info text-center">@<?= $user->name ?></p>
    </div>
    <div class="col-xs-10">
        <h3 class="news-item-title"><?= Html::a($model->title, ['/news/view', 'id' => $model->id]) ?></h3>

        <p class="news-item-meta">
            <time class="text-muted"><?= $formatter->asRelativeTime($model->createdAt) ?></time>
        </p>
        <p class="news-item-summary"><?= HtmlPurifier::process($model->summary) ?></p>
    </div>
</div>