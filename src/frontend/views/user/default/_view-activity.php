<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Activity;
use yii\web\View;

/**
 * @var $this View
 * @var $model Activity
 */
?>

<div class="timeline-item">
    <div class="row">
        <div class="col-xs-2 text-right">
            <small class="text-muted"><?= Yii::$app->formatter->asRelativeTime($model->createdAt) ?></small>
        </div>
        <div class="col-xs-10">
            <h4 style="padding-top: 0;margin-top: 0;"><?= $model->getContent() ?></h4>
        </div>
    </div>
</div>
