<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

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

$this->beginContent('@frontend/views/layouts/main.php');
?>
<div class="user-layout">
    <div class="user-layout-header">
        <div class="row">
            <div class="col-xs-1 col-xs-offset-9 text-center">
                <div>1200</div>
                <div>关注</div>
            </div>
            <div class="col-xs-1 text-center">
                <div>1200</div>
                <div>粉丝</div>
            </div>
        </div>
        <?= Html::img($user->getAvatarUrl(), ['class' => 'user-layout-header-avatar img-circle img-thumbnail']) ?>
        <h1 class="user-layout-header-title"><?= $user->name ?></h1>

        <p class="user-layout-header-toolbar">
            <?= Html::a('关注', [''], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-check"></i> 已关注', [''], ['class' => 'btn btn-default']) ?>
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
                ['label' => '我的主页', 'url' => ['/user/default/index', 'userId' => $user->id]],
                ['label' => '文章', 'url' => ['/user/article/index', 'userId' => $user->id]],
                ['label' => '管理中心', 'url' => ['/user/manage/default/index'],'visible'=>$user->id == $webUser->id],
            ]
        ]) ?>
        <?php NavBar::end() ?>
    </div>
    <?= $content ?>
</div>

<?php $this->endContent(); ?>
