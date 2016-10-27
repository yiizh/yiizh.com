<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use common\models\base\BaseAd;

/**
 */
class Ad extends BaseAd
{
    /**
     * @inheritdoc
     * @return \common\models\query\AdQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\AdQuery(get_called_class());
    }
}
