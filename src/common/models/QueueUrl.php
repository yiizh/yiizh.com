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

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['statusLabel'] = '状态';
        return $labels;
    }

    public function rules()
    {
        $rules = parent::rules();

        $rules[] = ['url', 'url'];
        return $rules;
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

    /**
     * @param string|array $urls
     * @return int 成功添加的 URL 条数
     */
    public static function add($urls)
    {
        if (is_string($urls)) {
            $urls = (array)$urls;
        }
        $success = 0;
        foreach ($urls as $url) {
            $model = new static();
            $model->url = $url;
            $model->status = self::STATUS_PENDING;
            if ($model->save()) {
                $success++;
            }
        }

        return $success;
    }
}
