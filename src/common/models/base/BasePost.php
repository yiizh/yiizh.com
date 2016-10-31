<?php

namespace common\models\base;

use common\models\User;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property integer $id
 * @property integer $authorId
 * @property string $title
 * @property string $slug
 * @property integer $type
 * @property string $originalUrl
 * @property string $contentMarkdown
 * @property string $contentHtml
 * @property integer $viewCount
 * @property string $deleted
 * @property string $publishStatus
 * @property string $publishDatetime
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BasePost extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['authorId', 'title', 'slug'], 'required'],
            [['authorId', 'type', 'viewCount', 'createdAt', 'updatedAt'], 'integer'],
            [['contentMarkdown', 'contentHtml', 'deleted', 'publishStatus'], 'string'],
            [['publishDatetime'], 'safe'],
            [['title', 'slug', 'originalUrl'], 'string', 'max' => 200],
            [['authorId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['authorId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'authorId' => '作者 ID',
            'title' => '标题',
            'slug' => 'Slug',
            'type' => '类型: 1, 原创;2, 转载',
            'originalUrl' => '原文链接',
            'contentMarkdown' => 'Markdown 内容',
            'contentHtml' => 'Html 内容',
            'viewCount' => '浏览量',
            'deleted' => '删除标识',
            'publishStatus' => '发布状态',
            'publishDatetime' => '发布日期',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
