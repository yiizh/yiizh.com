<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\News;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\web\View;

/**
 * @var $this View
 * @var $content string
 */
$user = Yii::$app->user;
$this->beginContent('@frontend/views/layouts/main.php');
?>
<?php NavBar::begin([
    'options' => [
        'class' => 'navbar-inverse',
    ],
]) ?>
<?= Nav::widget([
    'options' => [
        'class' => 'navbar-nav navbar-left'
    ],
    'items' => [
        ['label' => '系统设置', 'url' => ['/manage/system/index'], 'visible' => $user->can('manageSystem')],
        ['label' => '项目', 'visible' => $user->can('manageProject'), 'items' => [
            ['label' => '所有项目', 'url' => ['/manage/project/index']],
            ['label' => '新增项目', 'url' => ['/manage/project/create']],
        ]],
        ['label' => '新闻', 'visible' => $user->can('manageNews'), 'items' => [
            ['label' => '投稿', 'url' => ['/manage/news/index', 'status' => News::STATUS_PROPOSED]],
            ['label' => '发布', 'url' => ['/manage/news/index', 'status' => News::STATUS_PUBLISHED]],
            ['label' => '拒绝', 'url' => ['/manage/news/index', 'status' => News::STATUS_REJECTED]],
        ]],
    ]
]) ?>
<?php NavBar::end() ?>
<?= $content ?>
<?php $this->endContent(); ?>
