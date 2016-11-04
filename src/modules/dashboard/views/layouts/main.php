<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\widgets\Alert;
use yii\bootstrap\Modal;
use yii\web\View;
use yii\widgets\Breadcrumbs;


/**
 * @var $this View
 * @var $content string
 */

$app = Yii::$app;

$this->beginContent('@modules/dashboard/views/layouts/blank.php');
?>
<div class="wrapper">
    <?= $this->render('_header', [
        'app' => $app
    ]) ?>
    <?= $this->render('_sidebar', ['app' => $app]) ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><?= $this->title ?></h1>
            <?= Breadcrumbs::widget([
                'options' => [
                    'class' => 'breadcrumb',
                    'style' => 'float: none; position: static;'
                ],
                'homeLink' => ['label' => '首页', 'url' => ['/dashboard/default/index']],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </section>
        <!-- Main content -->
        <section class="content">
            <?= Alert::widget() ?>
            <?= $content ?>
        </section>
    </div>
    <?= $this->render('_footer', [
        'app' => $app
    ]) ?>
    <?php if (isset($this->params['rightBar'])): ?>
        <?= $this->render('_right', $this->params['rightBar']) ?>
    <?php endif; ?>
</div>
<?php Modal::begin([
    'id' => 'modal-default',
    'header' => '<h4 class="modal-title">操作</h4>'
]) ?>
<?php Modal::end() ?>
<?php
$this->endContent();
?>
