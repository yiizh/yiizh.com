<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use common\models\base\BaseAdPositionItem;
use common\models\query\AdPositionQuery;
use common\models\query\AdQuery;

/**
 * @property AdPosition $position
 * @property Ad $ad
 */
class AdPositionItem extends BaseAdPositionItem
{
    public $name;

    /**
     * @inheritdoc
     * @return \common\models\query\AdPositionItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AdPositionItemQuery(get_called_class());
    }

    public static function primaryKey()
    {
        return ['positionId', 'adId'];
    }

    /**
     * @return AdPositionQuery
     */
    public function getPosition()
    {
        return $this->hasOne(AdPosition::className(), ['id' => 'positionId']);
    }

    /**
     * @return AdQuery
     */
    public function getAd()
    {
        return $this->hasOne(Ad::className(), ['id' => 'adId']);
    }
}
