<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%content_pool}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $publishDatetime
 * @property string $from
 * @property string $status
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseContentPool extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content_pool}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['description', 'status'], 'string'],
            [['publishDatetime'], 'safe'],
            [['createdAt', 'updatedAt'], 'integer'],
            [['url', 'title'], 'string', 'max' => 200],
            [['from'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'URL 地址',
            'title' => '标题',
            'description' => '内容',
            'publishDatetime' => '原文发布时间',
            'from' => '来源',
            'status' => '状态',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
