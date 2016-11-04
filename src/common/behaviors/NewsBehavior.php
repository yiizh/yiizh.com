<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\behaviors;


use common\models\Activity;
use common\models\News;
use common\models\QueueUrl;
use yii\base\Behavior;
use yii\base\Event;

/**
 * @package common\behaviors
 * @property News $owner
 */
class NewsBehavior extends Behavior
{
    public function events()
    {
        return [
            News::EVENT_AFTER_PUBLISH => 'afterPublish'
        ];
    }

    /**
     * @param Event $event
     */
    public function afterPublish($event)
    {
        $this->generateActivity();
        $this->generateQueueUrl();
    }

    /**
     * 生成作者动态
     */
    protected function generateActivity()
    {
        $owner = $this->owner;
        $activity = new Activity();
        $activity->userId = $owner->userId;
        $activity->objectType = Activity::TYPE_NEWS;
        $activity->objectId = $owner->id;
        $activity->save();
    }

    /**
     * 生成推送 URL
     */
    protected function generateQueueUrl()
    {
        $owner = $this->owner;
        QueueUrl::add([
            $owner->getUrl(true)
        ]);
    }
}