<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Project;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\web\View;

/**
 * @var $this View
 * @var $model Project
 */
$formatter = Yii::$app->formatter;
?>
<div class="project-item">
    <h3 class="project-item-title"><?= Html::a($model->name, $model->getUrl()) ?></h3>
    <p class="project-item-meta">
        <time><?= $formatter->asRelativeTime($model->createdAt) ?></time>
    </p>
    <p class="project-item-summary"><?= StringHelper::truncateWords($model->description, 1, '', true) ?></p>
</div>