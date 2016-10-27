<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%ad_position}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseAdPosition extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad_position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['code', 'name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'code' => '代号',
            'name' => '名称',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
