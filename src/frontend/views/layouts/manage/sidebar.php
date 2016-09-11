<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * @var $this View
 * @var $content string
 */
$user = Yii::$app->user;
$this->beginContent('@frontend/views/layouts/manage/main.php');

$sidebarTitle = ArrayHelper::getValue($this->params, 'sidebar.title');
$sidebarItems = ArrayHelper::getValue($this->params, 'sidebar.items', []);
?>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default sidebar">
            <div class="panel-heading">
                <h4 class="panel-title"><?= $sidebarTitle ?></h4>
            </div>
            <?= Nav::widget([
                'items' => $sidebarItems
            ]) ?>
        </div>
    </div>
    <div class="col-md-9"><?= $content ?></div>
</div>
<?php $this->endContent(); ?>
