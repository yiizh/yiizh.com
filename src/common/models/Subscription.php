<?php

namespace common\models;

use common\models\base\BaseSubscription;
use common\subscription\RssSubscription;

/**
 */
class Subscription extends BaseSubscription
{
    /**
     * @var RssSubscription|null
     */
    private $_rssSubscription;

    /**
     * @inheritdoc
     * @return \common\models\query\SubscriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SubscriptionQuery(get_called_class());
    }

    /**
     * @return RssSubscription
     */
    public function getRssSubscription()
    {
        if ($this->_rssSubscription == null) {
            $this->_rssSubscription = new RssSubscription([
                'rss' => $this->url
            ]);
        }
        return $this->_rssSubscription;
    }

    /**
     * @return \modules\dashboard\models\RssItem[]
     */
    public function getItems()
    {
        $rss = $this->getRssSubscription();
        return $rss->getItems();
    }

    /**
     * @return \modules\dashboard\models\RssChannel
     */
    public function getChannel()
    {
        $rss = $this->getRssSubscription();
        return $rss->getChannel();
    }
}
