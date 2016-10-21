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
 */

?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?= Nav::widget([
            'menuId'=>'main-sidebar',
            'options' => [
                'class' => 'sidebar-menu'
            ],
        ]) ?>
    </section>
    <!-- /.sidebar -->
</aside>
