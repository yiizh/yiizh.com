<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\MailContent;

/**
 * @var $this yii\web\View
 * @var $model common\models\QueueMail
 * @var $mailContent MailContent
 */

$this->title = '新增邮件队列';
$this->params['breadcrumbs'][] = ['label' => '邮件队列', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-mail-create">

    <div class="box">
        <div class="box-body">
            <?= $this->render('_form', [
                'model' => $model,
                'mailContent' => $mailContent
            ]) ?>
        </div>
    </div>
</div>
