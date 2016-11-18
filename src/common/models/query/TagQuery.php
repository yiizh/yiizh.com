<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Tag]].
 *
 * @see \common\models\Tag
 */
class TagQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return \common\models\Tag[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Tag|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
