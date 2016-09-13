<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Module;
use common\widgets\JsBlock;
use common\widgets\Panel;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $modules Module[]
 */

$this->title = '已安装 - 模块';
?>
<?php JsBlock::begin() ?>
<script>
    $(document).on('click', '.btn-uninstall', function (e) {
        e.preventDefault();

        $this = $(this);
        $.ajax({
            url: $this.attr('href'),
            type: 'post',
            dataType: 'json',
            beforeSend: function (request) {
                $this.text('正在卸载...')
                    .addClass('disabled');
            },
            success: function (rs) {
                location.reload();
            }
        });
    });
</script>
<?php JsBlock::end() ?>
<div class="manage-module-index">
    <?php Panel::begin([
        'title' => '已安装'
    ]) ?>

    <?php foreach ($modules as $module): ?>
        <div>
            <h4><?= $module->name ?></h4>
            <p><?= $module->description ?></p>
            <div>
                <?= Html::a('卸载', ['uninstall', 'id' => $module->id], ['class' => 'btn btn-danger btn-uninstall']) ?>
            </div>
        </div>
    <?php endforeach; ?>

    <?php Panel::end() ?>
</div>
