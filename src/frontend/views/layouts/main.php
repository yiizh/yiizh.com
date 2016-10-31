<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/**
 * @var $this View
 * @var $content string
 * @var $user yii\web\User
 * @var $identity \common\models\User
 */

$user = Yii::$app->user;
$identity = $user->getIdentity();

$mainItems = [];
$rightItems = [];
$mainItems[] = ['label' => '资讯', 'url' => ['/news/news/index']];
$mainItems[] = ['label' => '开源项目', 'url' => ['/project/project/index']];
$mainItems[] = ['label' => '文章', 'url' => ['/post/post/index']];
$mainItems[] = ['label' => '网址导航', 'url' => 'http://i.yiizh.com', 'linkOptions' => ['target' => '_blank']];

$rightItems[] = ['label' => '控制台', 'url' => ['/dashboard/default/index'], 'visible' => $user->can('manage')];
if (Yii::$app->user->isGuest) {
    $rightItems[] = ['label' => '登录', 'url' => ['/site/login']];
    $rightItems[] = ['label' => '注册', 'url' => ['/site/register']];
} else {
    $rightItems[] = [
        'label' => Html::img($identity->getAvatarUrl()) . ' ' . $identity->name,
        'options' => ['class' => 'top-user-avatar'],
        'url' => ['/account/profile'], 'items' => [
            ['label' => '我的主页', 'url' => ['/user/default/index', 'userId' => $identity->id]],
            ['label' => '个人资料', 'url' => ['/account/profile/index']],
            '<li class="divider"></li>',
            ['label' => '退出', 'url' => ['/site/logout'], 'linkOptions' => [
                'data' => [
                    'method' => 'post'
                ]
            ]],
        ], 'position' => 'right'];
}

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?= Url::to('@web/favicon.ico') ?>" type="image/x-icon"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode(ArrayHelper::getValue($this->params, 'pageTitle', $this->title . '_' . Yii::$app->name)) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <header class="main-header">
            <?php
            NavBar::begin([
                'id' => 'navbar-top',
                'brandLabel' => Html::img('@web/static/images/logo-with-text.png', ['class' => 'logo']),
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-default navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'encodeLabels' => false,
                'items' => $mainItems,
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $rightItems,
            ]);
            NavBar::end();
            ?>
        </header>

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
            <p class="pull-left">
                <span class="copyright">&copy; yiizh.com <?= date('Y') ?></span>
                <?php if (($cnzz = Settings::get(Settings::TONGJI_CNZZ)) != ''): ?>
                    <span>&bull; <?= $cnzz ?></span>
                <?php endif; ?>
            </p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
    <script type="text/javascript">
        with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
    </script>
    <?= Settings::get(Settings::TAOBAO_UNION) ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>