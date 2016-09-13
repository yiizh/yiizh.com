<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%module}}".
 *
 * @property integer $id
 * @property string $moduleId
 * @property string $name
 * @property string $description
 * @property string $github
 * @property string $keywords
 * @property string $version
 * @property string $config
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseModule extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%module}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleId', 'name', 'description', 'github'], 'required'],
            [['config'], 'string'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['moduleId', 'name', 'keywords'], 'string', 'max' => 200],
            [['description', 'github'], 'string', 'max' => 500],
            [['version'], 'string', 'max' => 50],
            [['moduleId'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'moduleId' => '模块 ID',
            'name' => '模块名',
            'description' => '模块描述',
            'github' => 'Github 地址',
            'keywords' => '关键字',
            'version' => '版本号',
            'config' => '模块配置',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
