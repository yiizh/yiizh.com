<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use modules\user\assets\UserAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $content string
 * @var $user common\models\User
 * @var $webUser yii\web\User
 */
$webUser = Yii::$app->user;
$user = $this->context->findUser(Yii::$app->request->get('userId'));

UserAsset::register($this);
$this->beginContent('@frontend/views/layouts/main.php');
?>
<div class="user-layout">
    <div class="user-layout-header">
        <?= Html::img($user->getAvatarUrl(), ['class' => 'user-layout-header-avatar img-circle img-thumbnail']) ?>
        <h1 class="user-layout-header-title"><?= $user->name ?></h1>

        <p class="user-layout-header-toolbar">
        </p>
        <?php NavBar::begin([
            'renderInnerContainer' => false,
            'options' => [
                'class' => 'navbar-default',
            ],
        ]) ?>
        <?= Nav::widget([
            'options' => [
                'class' => 'navbar-nav navbar-center'
            ],
            'items' => [
                ['label' => '主页', 'url' => ['/user/default/index', 'userId' => $user->id]],
            ]
        ]) ?>
        <?php NavBar::end() ?>
    </div>
    <?= $content ?>
</div>

<?php $this->endContent(); ?>
