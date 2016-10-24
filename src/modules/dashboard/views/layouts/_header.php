<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\User;
use common\widgets\Nav;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $identity User
 */
$identity = Yii::$app->user->getIdentity();

$rightNavItems[] = ['label' => '前台首页', 'url' => Yii::$app->homeUrl];
$rightNavItems[] = [
    'label' => Html::img($identity->getAvatarUrl(), ['class' => 'top-user-avatar', 'width' => 20, 'height' => 20]) . ' ' . $identity->name,
    'url' => ['/account/profile'],
    'items' => [
        ['label' => '我的主页', 'url' => ['/user/default/index', 'userId' => $identity->id]],
        ['label' => '个人资料', 'url' => ['/account/profile']],
        '<li class="divider"></li>',
        ['label' => '退出', 'url' => ['/site/logout'], 'linkOptions' => [
            'data' => [
                'method' => 'post'
            ]
        ]],
    ], 'position' => 'right'];

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
                'encodeLabels' => false,
                'options' => [
                    'class' => 'navbar-nav'
                ],
                'items' => $rightNavItems
            ]) ?>
        </div>
    </nav>
</header>

