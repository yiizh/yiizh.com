<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use common\models\base\BaseQueueUrl;
use yii\helpers\ArrayHelper;

/**
 */
class QueueUrl extends BaseQueueUrl
{
    const STATUS_PENDING = 'pending';
    const STATUS_PUSHED = 'pushed';

    /**
     * @inheritdoc
     * @return \common\models\query\QueueUrlQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\QueueUrlQuery(get_called_class());
    }

    /**
     * @return array
     */
    public static function getStatusItems()
    {
        return [
            self::STATUS_PENDING => '等待中',
            self::STATUS_PUSHED => '已推送'
        ];
    }

    /**
     * @param string $status
     * @return null|string
     */
    public static function statusItemLabel($status)
    {
        return ArrayHelper::getValue(static::getStatusItems(), $status);
    }

    /**
     * @return string|null
     */
    public function getStatusLabel()
    {
        return static::statusItemLabel($this->status);
    }
}
