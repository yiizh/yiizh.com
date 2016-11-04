<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;

use common\models\QueueMail;
use console\components\BaseConsoleController;

class MailController extends BaseConsoleController
{
    /**
     * 发送邮件
     *
     * @param int $id 邮件队列 ID
     */
    public function actionSend($id)
    {
        $model = $this->findModel($id);
        if ($model == null) {
            echo "Mail queue #{$id} not exists." . PHP_EOL;
        } elseif ($model->status == QueueMail::STATUS_SEND) {
            echo "Mail queue #{$id} is already sent." . PHP_EOL;
        } elseif ($model->status == QueueMail::STATUS_PENDING) {
            $mailContent = $model->mailContent;
            if ($mailContent == null) {
                echo "Mail queue #{$id} has not mail content." . PHP_EOL;
            } else {
                if ($model->send()) {
                    echo "Mail queue #{$id} send successfully." . PHP_EOL;
                } else {
                    echo "Mail queue #{$id} send failed." . PHP_EOL;
                }
            }
        }
    }

    /**
     * 自动发送队列中的邮件
     *
     * @param int $limit
     * @return int
     */
    public function actionAutoSend($limit = 1000)
    {
        $query = QueueMail::find()
            ->pending()
            ->limit($limit);
        $count = $query->count();
        echo "{$count} mail need to send." . PHP_EOL;

        $successCount = 0;
        if ($count == 0) {
            echo "No email to send." . PHP_EOL;
            return self::EXIT_CODE_NORMAL;
        }

        $models = $query->all();
        foreach ($models as $model) {
            if ($model->send()) {
                $successCount++;
            }
        }

        echo "Send {$successCount} mail successfully." . PHP_EOL;
    }

    protected function findModel($id)
    {
        return QueueMail::findOne($id);
    }
}