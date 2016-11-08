<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\ContentPool;
use modules\dashboard\models\RssItem;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $model RssItem
 */
?>
<div>
    <h3><?= Html::a($model->title, $model->link, ['target' => '_blank']) ?></h3>
    <p class="text-muted"><?= $model->publishDatetime ?></p>
    <p>
        <?php if (ContentPool::isExistsByUrl($model->link)): ?>
            <?= Html::a('已添加', 'javascript: void(0);', ['class' => 'btn btn-sm btn-success disabled']) ?>
        <?php else: ?>
            <?= Html::a('添加到内容池', 'javascript: void(0);', ['class' => 'btn btn-sm btn-default', 'data' => [
                'url' => Url::to(['content/pool/add']),
                'toggle' => 'ajax-post',
                'success' => '已添加',
                'data' => [
                    'ContentPool[title]' => $model->title,
                    'ContentPool[url]' => $model->link,
                    'ContentPool[description]' => $model->description,
                    'ContentPool[from]' => $model->channel->title . " <{$model->channel->link}>",
                ]
            ]]) ?>
        <?php endif; ?>
    </p>

    <div><?= $model->description ?></div>
</div>
