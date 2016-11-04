<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%queue_mail}}".
 *
 * @property integer $id
 * @property string $fromName
 * @property string $fromMail
 * @property string $to
 * @property integer $mailContentId
 * @property string $status
 * @property string $sendDatetime
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseQueueMail extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%queue_mail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fromName', 'fromMail', 'to', 'mailContentId'], 'required'],
            [['mailContentId', 'createdAt', 'updatedAt'], 'integer'],
            [['status'], 'string'],
            [['sendDatetime'], 'safe'],
            [['fromName', 'fromMail', 'to'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'fromName' => '发件人名称',
            'fromMail' => '发件人邮箱',
            'to' => '收件人邮箱',
            'mailContentId' => '邮件内容 ID',
            'status' => '状态',
            'sendDatetime' => '发送时间',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
