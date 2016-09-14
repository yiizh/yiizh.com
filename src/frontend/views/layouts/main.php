<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\components\SettingsManager;
use common\models\Settings;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\widgets\TopNavBar;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/**
 * @var $this View
 * @var $content string
 * @var $settings SettingsManager
 * @var $user yii\web\User
 * @var $identity \common\models\User
 */
AppAsset::register($this);
$user = Yii::$app->user;
$identity = $user->getIdentity();

$settings = Yii::$app->settings;

$keywords = $settings->get(Settings::SITE_KEYWORDS);
$description = $settings->get(Settings::SITE_DESCRIPTION);

$this->registerMetaTag(['name' => 'keywords', 'content' => $keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $description]);

$items = [];

// left items
$items[] = ['label' => '首页', 'url' => ['/site/index'], 'position' => 'left'];
$items[] = ['label' => '资讯', 'url' => ['/news/index'], 'position' => 'left'];
$items['demo'] = ['label' => '演示', 'position' => 'left'];

// right items
$items[] = ['label' => '管理', 'url' => ['/manage/default/index'], 'visible' => Yii::$app->user->can('manager'), 'position' => 'right'];
if ($user->isGuest) {
    $items[] = ['label' => '登录', 'url' => ['/site/login'], 'position' => 'right'];
    $items[] = ['label' => '注册', 'url' => ['/site/register'], 'position' => 'right'];
} else {
    $items[] = ['label' => Html::img($identity->getAvatarUrl(), ['class' => 'top-user-avatar']) . ' ' . $identity->name, 'url' => ['/account/profile'], 'items' => [
        ['label' => '我的主页', 'url' => ['/user/default/index', 'userId' => $identity->id]],
        ['label' => '个人资料', 'url' => ['/account/profile']],
        '<li class="divider"></li>',
        ['label' => '退出', 'url' => ['/site/logout'], 'linkOptions' => [
            'data' => [
                'method' => 'post'
            ]
        ]],
    ], 'position' => 'right'];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?>_<?= $settings->get(Settings::SITE_NAME) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?= TopNavBar::widget([
        'items' => $items,
        'id' => 'top-navbar',
        'options' => [

        ],
        'navbarOptions' => [
            'class' => 'navbar-default navbar-fixed-top',
        ]
    ]) ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= Alert::widget() ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy;yiizh.com <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
