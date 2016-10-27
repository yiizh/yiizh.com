<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\AdPositionItem]].
 *
 * @see \common\models\AdPositionItem
 */
class AdPositionItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\AdPositionItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\AdPositionItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
