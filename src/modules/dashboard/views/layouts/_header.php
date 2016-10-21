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

$rightNavItems = [
    ['label' => '管理员', 'items' => [
        ['label' => '修改密码', 'url' => ['/manager/account/change-password']],
        '<li class="divider"></li>',
        ['label' => '退出', 'url' => ['/site/logout'], ['data' => ['method' => 'post']]]
    ]],
];

?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?= $app->homeUrl ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">管理平台</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">管理平台</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <?= Nav::widget([
            'menuId' => 'main-navbar',
            'options' => [
                'class' => 'navbar-nav'
            ],
        ]) ?>
        <div class="navbar-custom-menu">
            <?= Nav::widget([
                'options' => [
                    'class' => 'navbar-nav'
                ],
                'items' => $rightNavItems
            ]) ?>
        </div>
    </nav>
</header>

