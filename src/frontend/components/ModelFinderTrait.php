<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\components;


use common\models\Module;
use common\models\User;
use yii\web\NotFoundHttpException;

trait ModelFinderTrait
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

    /**
     * @param int $id
     * @return array|Module|null
     * @throws NotFoundHttpException
     */
    public function findModule($id){
        $model = Module::find()
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