<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

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
 * @var $user yii\web\User
 * @var $identity \common\models\User
 */

$user = Yii::$app->user;
$identity = $user->getIdentity();

$mainItems = [];
$rightItems = [];
$mainItems[] = ['label' => '头条', 'url' => ['/news/index']];

if (Yii::$app->user->isGuest) {
    $rightItems[] = ['label' => '登录', 'url' => ['/site/login']];
    $rightItems[] = ['label' => '注册', 'url' => ['/site/register']];
} else {
    $rightItems[] = ['label' => Html::img($identity->getAvatarUrl(), ['class' => 'top-user-avatar']) . ' ' . $identity->name, 'url' => ['/account/profile'], 'items' => [
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

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>


    <div class="wrap">
        <header class="main-header">
            <?php
            NavBar::begin([
                'id' => 'navbar-top',
                'brandLabel' => 'Yii &bull; 中文',
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
            <p class="pull-left">&copy; yiizh.com <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>