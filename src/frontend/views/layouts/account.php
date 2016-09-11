<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\bootstrap\Nav;
use yii\web\View;

/**
 * @var $this View
 * @var $content string
 */
$this->beginContent('@frontend/views/layouts/main.php');
?>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default sidebar">
            <div class="panel-heading">
                <h4 class="panel-title">帐号</h4>
            </div>
            <?= Nav::widget([
                'items' => [
                    ['label' => '个人资料', 'url' => ['/account/profile']],
                    ['label' => '修改密码', 'url' => ['/account/change-password']],
                    ['label' => '帐号绑定', 'url' => ['/openid/index']],
                ]
            ]) ?>
        </div>
    </div>
    <div class="col-md-9"><?= $content ?></div>
</div>
<?php $this->endContent(); ?>
