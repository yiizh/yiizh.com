<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\subscription;

use modules\dashboard\models\RssChannel;
use modules\dashboard\models\RssItem;
use yii\base\Object;
use Zend\Feed\Reader\Feed\FeedInterface;
use Zend\Feed\Reader\Reader;

class RssSubscription extends Object
{
    public $rss = 'http://www.yiiframework.com/rss.xml/';

    /**
     * @var FeedInterface
     */
    private $reader;

    public function init()
    {
        parent::init();
        $this->reader = Reader::importString(file_get_contents($this->rss));
    }

    /**
     * @return RssChannel
     */
    public function getChannel()
    {
        $reader = $this->reader;
        $formatter = \Yii::$app->formatter;
        $urlinfo = parse_url($this->rss);
        $scheme = $urlinfo['scheme'];
        $host = $urlinfo['host'];

        $link = $reader->getLink();
        if (substr($link, 0, 4) != 'http') {
            $link = $scheme . '://' . $host . (substr($link, 0, 1) == '/' ? '' : '/') . $link;
        }

        $channel = new RssChannel();
        $channel->title = $reader->getTitle();
        $channel->description = $reader->getDescription();
        $channel->link = $link;
        $channel->language = $reader->getLanguage();
        $channel->modifyDatetime = $formatter->asDatetime($reader->getDateModified(), 'php:Y-m-d H:i:s');
        return $channel;
    }

    /**
     * @return RssItem[]
     */
    public function getItems()
    {
        $items = [];
        $formatter = \Yii::$app->formatter;
        $channel = $this->getChannel();
        foreach ($this->reader as $item) {
            $model = new RssItem();
            $model->title = $item->getTitle();
            $model->link = $item->getLink();
            $model->description = $item->getDescription();
            $model->publishDatetime = $formatter->asDatetime($item->getDateModified(), 'php:Y-m-d H:i:s');
            $model->channel = $channel;
            $items[] = $model;
        }
        return $items;
    }
}