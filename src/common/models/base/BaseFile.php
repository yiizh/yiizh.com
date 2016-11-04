<?php

namespace common\models\base;

use common\models\User;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $id
 * @property integer $uploaderId
 * @property string $name
 * @property string $path
 * @property string $mimeType
 * @property string $extension
 * @property integer $size
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseFile extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uploaderId', 'name'], 'required'],
            [['uploaderId', 'size', 'createdAt', 'updatedAt'], 'integer'],
            [['name', 'path', 'mimeType'], 'string', 'max' => 200],
            [['extension'], 'string', 'max' => 50],
            [['uploaderId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['uploaderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'uploaderId' => '上传者',
            'name' => '文件名',
            'path' => '存储路径',
            'mimeType' => 'Mime Type',
            'extension' => '扩展名',
            'size' => '文件大小',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
