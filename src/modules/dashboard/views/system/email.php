<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use yii\web\View;

/**
 * @var $this View
 * @var $settings Settings[]
 */

$this->title = '邮箱设置';
?>
<div class="manage-system-email">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= $this->title ?>
            </h4>
        </div>
        <div class="panel-body">
            <?= $this->render('_form-settings-input', ['models' => $settings]) ?>
        </div>
    </div>
</div>
