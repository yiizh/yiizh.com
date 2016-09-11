<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $authKey
 * @property string $passwordHash
 * @property string $passwordResetToken
 * @property integer $status
 * @property string $avatar
 * @property string $weibo
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseUser extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name', 'authKey'], 'required'],
            [['status', 'createdAt', 'updatedAt'], 'integer'],
            [['email', 'avatar'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 50],
            [['authKey'], 'string', 'max' => 32],
            [['passwordHash', 'passwordResetToken', 'weibo'], 'string', 'max' => 100],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'email' => '邮箱',
            'name' => '昵称',
            'authKey' => '授权秘钥',
            'passwordHash' => '加密密钥',
            'passwordResetToken' => '重置密码令牌',
            'status' => '状态',
            'avatar' => '头像地址',
            'weibo' => '绑定的微博账号',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
