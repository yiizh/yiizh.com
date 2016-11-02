<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%queue_url}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $status
 * @property string $pushDatetime
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseQueueUrl extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%queue_url}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['status'], 'string'],
            [['pushDatetime'], 'safe'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['url'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'url' => 'URL',
            'status' => 'Status',
            'pushDatetime' => '推送时间',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
