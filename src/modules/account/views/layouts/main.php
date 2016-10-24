<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\widgets\Nav;
use yii\web\View;

/**
 * @var $this View
 * @var $content string
 */

$this->beginContent('@frontend/views/layouts/main.php');
?>
<div class="row">
    <div class="col-xs-3">
        <div class="box thin-padding">
            <div class="box-body">
                <?=Nav::widget([
                    'menuId'=>'user-account',
                    'options'=>[
                        'class'=>'nav nav-pills nav-stacked'
                    ]
                ])?>
            </div>
        </div>

    </div>
    <div class="col-xs-9">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>
