<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\widgets\JsBlock;
use common\widgets\Panel;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $modules []
 * @var $installedModuleIds []
 */

$this->title = '发现 - 模块';
?>
<?php JsBlock::begin() ?>
<script>
    $(document).on('click', '.btn-install', function (e) {
        e.preventDefault();

        $this = $(this);
        $.ajax({
            url: $this.attr('href'),
            type: 'post',
            dataType: 'json',
            beforeSend: function (request) {
                $this.text('正在安装...')
                    .addClass('disabled');
            },
            success: function (rs) {
                if (rs.success) {
                    $this.text('已安装')
                        .attr('href', 'javascript: void(0);')
                        .removeClass('disabled btn-install');
                } else {
                    alert('安装失败。');
                }
            }
        });
    });
</script>
<?php JsBlock::end() ?>
<div class="manage-module-explore">
    <?php Panel::begin([
        'title' => '发现'
    ]) ?>

    <?php foreach ($modules as $module): ?>
        <div>
            <h4><?= $module['name'] ?></h4>
            <p><?= $module['description'] ?></p>
            <div>
                <?php if (in_array($module['id'], $installedModuleIds)): ?>
                    <?= Html::a('已安装', 'javascript: void(0);', ['class' => 'btn btn-default']) ?>
                <?php else: ?>
                    <?= Html::a('安装', ['install', 'id' => $module['id']], ['class' => 'btn btn-success btn-install']) ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <?php Panel::end() ?>
</div>
