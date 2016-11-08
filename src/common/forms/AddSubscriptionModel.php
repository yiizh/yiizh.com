<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\forms;


class AddSubscriptionModel extends FormModel
{
    public $url;

    public function attributeLabels()
    {
        return [
            'url' => 'Rss/Feed 地址',
        ];
    }

    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
        ];
    }

}