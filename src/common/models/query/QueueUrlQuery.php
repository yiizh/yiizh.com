<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models\query;

use common\models\QueueUrl;

/**
 * This is the ActiveQuery class for [[\common\models\QueueUrl]].
 *
 * @see \common\models\QueueUrl
 */
class QueueUrlQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\QueueUrl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\QueueUrl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return static
     */
    public function pending()
    {
        return $this->andWhere([
            'status' => QueueUrl::STATUS_PENDING
        ]);
    }
}
