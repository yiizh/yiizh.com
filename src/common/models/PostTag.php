<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use common\models\base\BasePostTag;

/**
 */
class PostTag extends BasePostTag
{
    /**
     * @inheritdoc
     * @return \common\models\query\PostTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PostTagQuery(get_called_class());
    }
}
