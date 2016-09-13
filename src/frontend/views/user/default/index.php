<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var $this View
 * @var $activityProvider ActiveDataProvider
 * @var $model User
 */
$this->title = $model->name;
?>
<div class="user-default-index">
    <?= ListView::widget([
        'layout' => '{items} {pager}',
        'dataProvider' => $activityProvider,
        'itemView' => '_view-activity',
    ]) ?>
</div>
