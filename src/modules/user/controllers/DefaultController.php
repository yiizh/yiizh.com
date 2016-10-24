<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\user\controllers;

use common\models\Activity;
use modules\user\Controller;
use yii\data\ActiveDataProvider;

class DefaultController extends Controller
{
    public function publicActions()
    {
        return ['index'];
    }

    public function actionIndex($userId)
    {
        $model = $this->findUser($userId);
        $activityProvider = new ActiveDataProvider([
            'query' => Activity::find()->andWhere(['userId' => $model->id])->orderBy('createdAt DESC'),
            'sort' => false,
        ]);

        return $this->render('index', [
            'model' => $model,
            'activityProvider' => $activityProvider
        ]);
    }
}