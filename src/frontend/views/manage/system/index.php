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

$this->title = '站点设置';
?>
<div class="manage-system-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= $this->title ?>
            </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <?= $this->render('_form-settings', ['settings' => $settings]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
