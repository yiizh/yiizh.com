<?php

namespace common\models;

use common\models\base\BaseSubscription;
use common\subscription\RssSubscription;

/**
 */
class Subscription extends BaseSubscription
{
    /**
     * @inheritdoc
     * @return \common\models\query\SubscriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\SubscriptionQuery(get_called_class());
    }

    /**
     * @return \modules\dashboard\models\RssItem[]
     */
    public function getItems()
    {
        $rss = new RssSubscription([
            'rss' => $this->url
        ]);
        return $rss->getItems();
    }
}
