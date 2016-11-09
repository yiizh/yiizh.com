<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\behaviors;


use common\models\Post;
use common\models\QueueUrl;
use yii\base\Behavior;
use yii\base\Event;

/**
 * @package common\behaviors
 * @property Post $owner
 */
class PostBehavior extends Behavior
{
    public function events()
    {
        return [
            Post::EVENT_AFTER_PUBLISH => 'afterPublish'
        ];
    }

    /**
     * @param Event $event
     */
    public function afterPublish($event)
    {
        $this->generateQueueUrl();
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