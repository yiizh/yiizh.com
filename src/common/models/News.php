<?php

namespace common\models;

use common\models\base\BaseNews;
use common\models\query\NewsQuery;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * @property User $user
 */
class News extends BaseNews
{
    const STATUS_PROPOSED = 1;
    const STATUS_PUBLISHED = 10;
    const STATUS_REJECTED = 0;

    const SCENARIO_SUGGEST = 'suggest';
    const SCENARIO_UPDATE = 'update';

    /**
     * @inheritdoc
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SUGGEST] = ['title', 'summary', 'link'];
        $scenarios[self::SCENARIO_UPDATE] = ['title', 'summary', 'link', 'status'];
        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();

        $rules[] = ['link', 'url'];

        return $rules;
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        return static::statusLabel($this->status);
    }

    /**
     * @param int $status
     * @return string
     */
    public static function statusLabel($status)
    {
        $statuses = static::getStatusItems();
        return ArrayHelper::getValue($statuses, $status);
    }

    /**
     * @return array
     */
    public static function getStatusItems()
    {
        return [
            self::STATUS_PROPOSED => '投稿',
            self::STATUS_PUBLISHED => '发布',
            self::STATUS_REJECTED => '拒绝',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if (ArrayHelper::getValue($changedAttributes, 'status') != self::STATUS_PUBLISHED && $this->status == self::STATUS_PUBLISHED) {
            // 创建作者动态
            $activity = new Activity();
            $activity->userId = $this->userId;
            $activity->objectType = Activity::TYPE_NEWS;
            $activity->objectId = $this->id;
            $activity->save();
        }
    }

    /**
     * @param bool $scheme
     * @return string
     */
    public function getUrl($scheme = false)
    {
        return Url::to(['/news/news/view', 'id' => $this->id], $scheme);
    }
}
