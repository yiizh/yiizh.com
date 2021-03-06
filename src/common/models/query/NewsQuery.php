<?php

namespace common\models\query;

use common\models\News;

/**
 * This is the ActiveQuery class for [[News]].
 *
 * @see News
 */
class NewsQuery extends \yii\db\ActiveQuery
{

    /**
     * @inheritdoc
     * @return News[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return News|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return static
     */
    public function published()
    {
        return $this->andWhere([
            '[[status]]' => News::STATUS_PUBLISHED,
        ]);
    }

    /**
     * @param int $type
     * @return static
     */
    public function andByType($type)
    {
        return $this->andWhere([
            'type' => $type
        ]);
    }
}
