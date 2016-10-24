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
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <?= $this->render('_form-settings', ['settings' => $settings]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
