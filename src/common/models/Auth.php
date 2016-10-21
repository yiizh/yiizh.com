<?php

namespace common\models;

use common\models\base\BaseAuth;

/**
 * @property User $user
 */
class Auth extends BaseAuth
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

}
