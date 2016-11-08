<?php

namespace common\models\base;

/**
 * This is the model class for table "tbl_subscription".
 *
 * @property integer $id
 * @property string $url
 * @property string $channelTitle
 * @property string $link
 * @property string $description
 * @property string $modifyDatetime
 * @property integer $lastUpdatedAt
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class BaseSubscription extends \common\models\base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['modifyDatetime'], 'safe'],
            [['lastUpdatedAt', 'createdAt', 'updatedAt'], 'integer'],
            [['url', 'channelTitle', 'link'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 500],
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
            'channelTitle' => '频道标题',
            'link' => '链接',
            'description' => '描述',
            'modifyDatetime' => '修改时间',
            'lastUpdatedAt' => '上次更新时间',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }
}
