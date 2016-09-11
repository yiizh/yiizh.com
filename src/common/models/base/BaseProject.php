<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property integer $id
 * @property string $githubUrl
 * @property string $name
 * @property string $description
 * @property string $readme
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseProject extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['githubUrl'], 'required'],
            [['readme'], 'string'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['githubUrl'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'githubUrl' => 'GitHub URL',
            'name' => '项目名',
            'description' => '项目简介',
            'readme' => 'ReadMe',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
