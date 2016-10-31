<?php

namespace common\models\query;

use common\helper\DateTime;
use common\models\Post;

/**
 * This is the ActiveQuery class for [[\common\models\Post]].
 *
 * @see \common\models\Post
 */
class PostQuery extends \yii\db\ActiveQuery
{
    /**
     * @return static
     */
    public function active()
    {
        return $this->andWhere('[[deleted]]="N"');
    }

    /**
     * @inheritdoc
     * @return \common\models\Post[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Post|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * 已发布
     * @return static
     */
    public function published()
    {
        return $this->andWhere('publishDatetime <= :now', [':now' => DateTime::now()])
            ->andWhere([
                '[[publishStatus]]' => Post::PUBLISH_STATUS_PUBLISHED,
            ]);
    }
}
