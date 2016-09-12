<?php

namespace common\models\query;
use common\models\User;

/**
 * This is the ActiveQuery class for [[\common\models\base\User]].
 *
 * @see \common\models\base\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere([
            '[[status]]' => User::STATUS_ACTIVE
        ]);
    }

    /**
     * @inheritdoc
     * @return User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
