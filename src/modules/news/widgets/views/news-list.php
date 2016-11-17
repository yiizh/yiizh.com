<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $title string
 * @var $models News[]
 * @var $options array
 */
$formatter = Yii::$app->formatter;
?>
<div <?=Html::renderTagAttributes($options)?>>
    <div class="panel-heading">
        <h4 class="panel-title"><?= $title ?></h4>
    </div>
    <div class="list-group">
        <?php foreach ($models as $model): ?>
            <a class="list-group-item" href="<?= $model->getUrl() ?>">
                <time class="pull-right"><?= $formatter->asRelativeTime($model->createdAt) ?></time>
                <?= $model->title ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
