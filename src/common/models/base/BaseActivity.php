<?php

namespace common\models\base;

use common\models\User;

/**
 * This is the model class for table "{{%activity}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $objectType
 * @property integer $objectId
 * @property string $content
 * @property integer $createdAt
 */
class BaseActivity extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'objectType', 'objectId'], 'required'],
            [['userId', 'objectType', 'objectId', 'createdAt'], 'integer'],
            [['content'], 'string', 'max' => 200],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'userId' => '用户 ID',
            'objectType' => '对象类型',
            'objectId' => '对象 ID',
            'content' => '内容',
            'createdAt' => '创建时间',
        ];
    }
}
