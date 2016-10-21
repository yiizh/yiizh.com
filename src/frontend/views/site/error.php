<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use yii\helpers\Html;
use yii\web\View;

/**
 * @var $this View
 * @var $name string
 * @var $message string
 * @var $exception Exception
 */

$this->title = $name;
?>
<div class="site-error">
    <div class="box">
        <div class="box-body">
            <h1><?= Html::encode($this->title) ?></h1>

            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <p>
                The above error occurred while the Web server was processing your request.
            </p>
            <p>
                Please contact us if you think this is a server error. Thank you.
            </p>

        </div>
    </div>
</div>