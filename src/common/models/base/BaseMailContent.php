<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%mail_content}}".
 *
 * @property integer $id
 * @property string $subject
 * @property string $body
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseMailContent extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mail_content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['subject'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'subject' => '主题',
            'body' => '内容',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
