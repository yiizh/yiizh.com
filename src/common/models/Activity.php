<?php

namespace common\models;

use common\models\base\BaseActivity;
use common\models\query\ActivityQuery;
use yii\helpers\Html;

/**
 *
 * @property User $user
 */
class Activity extends BaseActivity
{
    const TYPE_NEWS = 1001;

    /**
     * @return ActivityQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * @inheritdoc
     * @return ActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActivityQuery(get_called_class());
    }

    /**
     * @return null|News
     */
    public function getObject()
    {
        switch ($this->objectType) {
            case self::TYPE_NEWS:
                return News::findOne(['id' => $this->objectId]);
                break;
        }
    }

    /**
     * @return null|string
     */
    public function getContent()
    {
        $content = null;
        $object = $this->getObject();
        if ($object == null) {
            return $content;
        }
        switch ($this->objectType) {
            case self::TYPE_NEWS:
                $content = Html::a('[资讯]', ['/news/news/index/']).' ' . Html::a($object->title, ['/news/news/view', 'id' => $object->id]);
                break;
        }
        return $content;
    }
}
