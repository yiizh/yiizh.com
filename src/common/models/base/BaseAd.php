<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%ad}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseAd extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'required'],
            [['name', 'content'], 'string'],
            [['createdAt', 'updatedAt'], 'integer'],
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
            'content' => '内容',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
