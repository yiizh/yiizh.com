<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\models;

use yii\base\Model;

class RssItem extends Model
{
    public $title;
    public $link;
    public $description;
    public $publishDatetime;

    /**
     * @var RssChannel
     */
    public $channel;
}