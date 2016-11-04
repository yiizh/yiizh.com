<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\MailContent;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model common\models\QueueMail
 * @var $mailContent MailContent
 */

$this->title = $mailContent->subject;
$this->params['breadcrumbs'][] = ['label' => '邮件队列', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-mail-view">

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $model,
                'template'=>'<tr><th width="180" {captionOptions}>{label}</th><td{contentOptions}>{value}</td></tr>',
                'attributes' => [
                    'id',
                    'fromName',
                    'fromMail',
                    'to',
                    'mailContent.subject',
                    'mailContent.body:raw',
                    'statusLabel',
                    'sendDatetime:datetime',
                    'createdAt:datetime',
                    'updatedAt:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
