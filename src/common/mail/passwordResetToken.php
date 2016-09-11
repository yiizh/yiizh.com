<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\User;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $user User
 */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/site/reset-password', 'token' => $user->passwordResetToken]);
?>

    您好 <?= Html::encode($user->name) ?>,

    请点击下面的链接重置密码:

<?= Html::a(Html::encode($resetLink), $resetLink) ?>