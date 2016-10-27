<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use common\models\base\BaseAdPosition;
use common\models\query\AdQuery;

/**
 * @property Ad[] $ads
 * @property AdPositionItem[] $items
 */
class AdPosition extends BaseAdPosition
{
    /**
     * @inheritdoc
     * @return \common\models\query\AdPositionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AdPositionQuery(get_called_class());
    }

    /**
     * @return AdQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ad::className(), ['id' => 'adId'])
            ->viaTable(AdPositionItem::tableName(), ['positionId' => 'id']);
    }

    public function getItems()
    {
        return $this->hasMany(AdPositionItem::className(), ['positionId' => 'id']);
    }
}
