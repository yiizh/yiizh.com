<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $license
 * @property string $description
 * @property string $homepage
 * @property string $docUrl
 * @property integer $viewCount
 * @property string $deleted
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
            [['name', 'license', 'description', 'homepage', 'docUrl'], 'required'],
            [['description', 'deleted'], 'string'],
            [['viewCount', 'createdAt', 'updatedAt'], 'integer'],
            [['name', 'homepage', 'docUrl'], 'string', 'max' => 200],
            [['license'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '项目名称',
            'license' => '授权协议',
            'description' => '描述',
            'homepage' => '项目主页',
            'docUrl' => '文档地址',
            'viewCount' => '浏览量',
            'deleted' => '删除标识',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
