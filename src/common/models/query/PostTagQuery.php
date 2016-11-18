<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\PostTag]].
 *
 * @see \common\models\PostTag
 */
class PostTagQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return \common\models\PostTag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\PostTag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
