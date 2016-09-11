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
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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

$rightItems = [];
$rightItems[] = ['label' => '管理', 'url' => ['/manage/default/index'], 'visible' => Yii::$app->user->can('manager')];

if ($user->isGuest) {
    $rightItems[] = ['label' => '登录', 'url' => ['/site/login']];
    $rightItems[] = ['label' => '注册', 'url' => ['/site/register']];
} else {
    $rightItems[] = ['label' => Html::img($identity->getAvatarUrl(), ['class' => 'top-user-avatar']) . ' ' . $identity->name, 'url' => ['/account/profile'], 'items' => [
        ['label' => '个人资料', 'url' => ['/account/profile']],
        '<li class="divider"></li>',
        ['label' => '退出', 'url' => ['/site/logout'], 'linkOptions' => [
            'data' => [
                'method' => 'post'
            ]
        ]],
    ]];
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
    <?php
    NavBar::begin([
        'id' => 'top-navbar',
        'brandLabel' => Html::img('@web/static/images/brand-logo.png', ['alt' => $settings->get(Settings::SITE_NAME)]),
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'title' => $settings->get(Settings::SITE_NAME)
        ],
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => '首页', 'url' => ['/site/index']],
            ['label' => '资讯', 'url' => ['/news/index']],
        ],
    ]);

    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $rightItems,
    ]);

    NavBar::end();
    ?>

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
