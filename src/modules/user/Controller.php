<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\user;


use common\components\BaseWebController;
use common\models\User;
use yii\web\NotFoundHttpException;

class Controller extends BaseWebController
{
    /**
     * @param int $id
     * @return User
     * @throws NotFoundHttpException
     */
    public function findUser($id)
    {
        $model = User::find()
            ->active()
            ->andWhere([
                'id' => $id,
            ])
            ->one();

        if ($model == null) {
            throw new NotFoundHttpException();
        }
        return $model;
    }
}