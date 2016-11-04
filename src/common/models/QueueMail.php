<?php

namespace common\models;

use common\helper\DateTime;
use common\models\base\BaseQueueMail;
use common\models\query\MailContentQuery;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\log\Logger;

/**
 * @property MailContent $mailContent
 */
class QueueMail extends BaseQueueMail
{
    const STATUS_PENDING = 'pending';
    const STATUS_SEND = 'send';

    /**
     * @inheritdoc
     * @return \common\models\query\QueueMailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\QueueMailQuery(get_called_class());
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['statusLabel'] = '状态';
        return $labels;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['to', 'email'];
        return $rules;
    }

    /**
     * @return array
     */
    public static function getStatusItems()
    {
        return [
            self::STATUS_PENDING => '等待中',
            self::STATUS_SEND => '已推送'
        ];
    }

    /**
     * @param string $status
     * @return null|string
     */
    public static function statusItemLabel($status)
    {
        return ArrayHelper::getValue(static::getStatusItems(), $status);
    }

    /**
     * @return string|null
     */
    public function getStatusLabel()
    {
        return static::statusItemLabel($this->status);
    }

    /**
     * @return MailContentQuery
     */
    public function getMailContent()
    {
        return $this->hasOne(MailContent::className(), ['id' => 'mailContentId']);
    }

    /**
     * @param MailContent $mailContent
     * @return bool
     */
    public function newMail(MailContent $mailContent)
    {
        $this->fromMail = $this->fromMail != null ? $this->fromMail : Settings::get(Settings::EMAIL_FROM_EMAIL);
        $this->fromName = Settings::get(Settings::EMAIL_FROM_NAME);

        if (!$mailContent->validate() && !$this->validate()) {
            return false;
        }
        $tr = static::getDb()->beginTransaction();
        try {
            if (!$mailContent->save()) {
                throw new Exception(Json::encode($mailContent->getErrors()));
            }
            $this->mailContentId = $mailContent->id;
            if (!$this->save()) {
                throw new Exception(Json::encode($this->getErrors()));
            }
            $tr->commit();
            return true;
        } catch (\Exception $e) {
            $tr->rollBack();
            \Yii::getLogger()->log($e->getMessage(), Logger::LEVEL_ERROR);
            return false;
        }
    }

    /**
     * 发送邮件
     *
     * @return bool
     */
    public function send()
    {
        $mailContent = $this->mailContent;
        if ($mailContent == null) {
            return false;
        }

        $mailContent->subject;
        $rs = \Yii::$app->mailer->compose()
            ->setFrom([$this->fromMail => $this->fromName])
            ->setTo($this->to)
            ->setSubject($mailContent->subject)
            ->setHtmlBody($mailContent->body)
            ->send();
        if (!$rs) {
            return false;
        }

        $this->status = self::STATUS_SEND;
        $this->sendDatetime = DateTime::now();

        return $this->save();
    }
}
