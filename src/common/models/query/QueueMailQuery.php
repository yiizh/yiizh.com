<?php

namespace common\models\query;
use common\models\QueueMail;

/**
 * This is the ActiveQuery class for [[\common\models\QueueMail]].
 *
 * @see \common\models\QueueMail
 */
class QueueMailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\QueueMail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\QueueMail|array|null
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
            'status' => QueueMail::STATUS_PENDING
        ]);
    }
}
