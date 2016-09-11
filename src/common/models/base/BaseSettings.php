<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $code
 * @property string $value
 * @property integer $isEncoded
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseSettings extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['isEncoded', 'createdAt', 'updatedAt'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description', 'code'], 'string', 'max' => 200],
            [['value'], 'string', 'max' => 2000],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '名称',
            'description' => '描述',
            'code' => '识别码',
            'value' => '值',
            'isEncoded' => '是否已编码',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
