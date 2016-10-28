<?php

namespace common\models\base;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property integer $userId
 * @property string $title
 * @property string $content
 * @property string $link
 * @property integer $status
 * @property integer $type
 * @property integer $projectId
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseNews extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'status', 'type', 'projectId', 'createdAt', 'updatedAt'], 'integer'],
            [['title'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['link'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => '用户 ID',
            'title' => '标题',
            'content' => '内容',
            'link' => '链接地址',
            'status' => '状态',
            'type' => '分类',
            'projectId' => '相关项目 ID',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
