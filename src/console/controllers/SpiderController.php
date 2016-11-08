<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;

use common\models\ContentPool;
use common\models\Subscription;
use console\components\BaseConsoleController;

/**
 * 爬取数据
 *
 */
class SpiderController extends BaseConsoleController
{
    /**
     * 爬取订阅的数据
     */
    public function actionSubscription()
    {
        $models = Subscription::find()->all();
        $count = 0;
        echo "Start fetch subscription data." . PHP_EOL;
        foreach ($models as $model) {
            $channel = $model->getChannel();
            foreach ($model->getItems() as $item) {
                if (!ContentPool::isExistsByUrl($item->link)) {
                    $contentPool = new ContentPool();
                    $contentPool->title = $item->title;
                    $contentPool->url = $item->link;
                    $contentPool->description = $item->description;
                    $contentPool->from = $channel->title . " <{$channel->link}>";
                    $contentPool->status = ContentPool::STATUS_TODO;
                    $contentPool->publishDatetime = $item->publishDatetime;

                    if ($contentPool->save()) {
                        $count++;
                    }
                }
            }
        }
        echo "Done! {$count} contents was saved to content pool." . PHP_EOL;
    }
}