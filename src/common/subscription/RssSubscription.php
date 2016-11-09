<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\subscription;

use modules\dashboard\models\RssChannel;
use modules\dashboard\models\RssItem;
use yii\base\ErrorException;
use yii\base\InvalidConfigException;
use yii\base\Object;
use yii\httpclient\Client;
use Zend\Feed\Reader\Feed\FeedInterface;
use Zend\Feed\Reader\Reader;

class RssSubscription extends Object
{
    public $rss;

    /**
     * @var FeedInterface
     */
    private $reader;

    public function init()
    {
        parent::init();
        if ($this->rss == null) {
            throw new InvalidConfigException('请配置 "rss"。');
        }
        $client = new Client();
        $resp = $client->createRequest()->setUrl($this->rss)->send();
        if (!$resp->getIsOk()) {
            throw new ErrorException("加载 rss '{$this->rss}' 失败");
        } else {
            $this->reader = Reader::importString($resp->getContent());
        }

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