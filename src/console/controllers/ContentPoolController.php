<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;

use common\models\ContentPool;
use common\models\MailContent;
use common\models\QueueMail;
use common\models\User;
use console\components\BaseConsoleController;

class ContentPoolController extends BaseConsoleController
{
    /**
     *
     */
    public function actionNotify()
    {
        $lastNotifyTime = $this->getLastNotifyTime();

        $query = ContentPool::find()
            ->andWhere(['status' => ContentPool::STATUS_TODO])
            ->andWhere(['>', 'createdAt', $lastNotifyTime]);
        if (!$query->exists()) {
            echo "No new content pool need to notify." . PHP_EOL;
        } else {
            $count = $query->count();
            $models = $query->all();
            $subject = "内容池有 {$count} 更新，请处理";
            $mailContent = new MailContent();
            $mailContent->subject = $subject;
            $mailContent->body = $this->renderPartial('notify', ['models' => $models]);

            $rbac = \Yii::$app->authManager;
            $userIds = $rbac->getUserIdsByRole('superManager');
            foreach ($userIds as $userId) {
                $user = User::findOne($userId);
                if ($user) {
                    $mail = new QueueMail();
                    $mail->fromName = $subject;
                    $mail->to = $user->email;
                    $mail->newMail($mailContent);
                }
            }
            $this->setLastNotifyTime(time());
        }
    }

    /**
     * @return int
     */
    public function getLastNotifyTime()
    {
        $lastNotifyTime = \Yii::$app->cache->get('ContentPool-lastNotifyTime');
        if (!$lastNotifyTime) {
            $lastNotifyTime = time();
            $this->setLastNotifyTime($lastNotifyTime);
        }
        return $lastNotifyTime;
    }

    /**
     * @param int $time
     */
    public function setLastNotifyTime($time)
    {
        \Yii::$app->cache->set('ContentPool-lastNotifyTime', $time);
    }
}