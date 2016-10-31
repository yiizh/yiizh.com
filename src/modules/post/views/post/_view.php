<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Post;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\web\View;

/**
 * @var $this View
 * @var $model Post
 */
$author = $model->author;
$formatter = Yii::$app->formatter;
?>
<div class="post-item highlight">
    <h3 class="post-item-title"><span class="post-type-original">[<?=$model->getTypeLabel()?>]</span> <?= Html::a($model->title, $model->getUrl()) ?></h3>
    <p class="post-item-meta">

        <time><?= $formatter->asRelativeTime($model->publishDatetime) ?></time>
        <a href="<?= $author->getUrl() ?>">@<?= $author->name ?></a>
    </p>
    <p class="post-item-summary"><?= StringHelper::truncateWords($model->contentHtml, 50, '', true) ?></p>
</div>
