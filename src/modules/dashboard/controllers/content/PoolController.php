<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers\content;


use common\models\ContentPool;
use yii\web\Response;

class PoolController extends Controller
{
    public function verbs()
    {
        return [
            'add' => ['post']
        ];
    }

    /**
     * @return array
     */
    public function actionAdd()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new ContentPool();
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
            ];
        } else {
            return [
                'success' => false,
                'errorMessage' => $model->getErrors()
            ];
        }
    }
}