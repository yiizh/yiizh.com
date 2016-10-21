<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Activity]].
 *
 * @see \common\models\Activity
 */
class ActivityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Activity[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Activity|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
