<?php

namespace common\models;

use common\models\base\BaseContentPool;
use yii\helpers\ArrayHelper;

/**
 */
class ContentPool extends BaseContentPool
{
    const STATUS_TODO = 'todo';
    const STATUS_IGNORE = 'ignore';
    const STATUS_PUBLISHED = 'published';

    /**
     * @inheritdoc
     * @return \common\models\query\ContentPoolQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ContentPoolQuery(get_called_class());
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['statusLabel'] = '状态';
        return $labels;
    }

    /**
     * @return array
     */
    public static function getStatusItems()
    {
        return [
            self::STATUS_TODO => '待处理',
            self::STATUS_IGNORE => '已忽略',
            self::STATUS_PUBLISHED => '已发布',
        ];
    }

    /**
     * @param int $status
     * @return string|null
     */
    public static function statusLabel($status)
    {
        return ArrayHelper::getValue(static::getStatusItems(), $status);
    }

    /**
     * @return null|string
     */
    public function getStatusLabel()
    {
        return static::statusLabel($this->status);
    }

    /**
     * @param string $url
     * @return bool
     */
    public static function isExistsByUrl($url)
    {
        return static::find()
            ->andWhere(['url' => $url])
            ->exists();
    }
}
