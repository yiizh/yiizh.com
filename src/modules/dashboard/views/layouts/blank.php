<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use modules\dashboard\assets\DashboardAsset;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $content string
 */
DashboardAsset::register($this);
Html::addCssClass($this->params['bodyAttributes']['class'], 'skin-blue');
if (isset($this->params['rightBar'])) {
    Html::addCssClass($this->params['bodyAttributes']['class'], 'fixed control-sidebar-open');
}
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body <?= Html::renderTagAttributes($this->params['bodyAttributes']) ?>>
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
    <?= Settings::get(Settings::TAOBAO_UNION) ?>
    </body>
    </html>
<?php $this->endPage() ?>