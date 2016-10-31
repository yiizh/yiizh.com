<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\post;

use common\components\BaseWebController;
use common\models\Post;
use yii\web\NotFoundHttpException;

class Controller extends BaseWebController
{
    /**
     * @param int $id
     * @return Post|null
     * @throws NotFoundHttpException
     */
    protected function findPost($id)
    {
        $model = Post::find()
            ->active()
            ->published()
            ->andWhere(['id' => $id])
            ->one();
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('页面未找到.');
        }
    }
}