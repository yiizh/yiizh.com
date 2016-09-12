<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers\user;


use common\models\Activity;
use frontend\components\BaseFrontendController;
use yii\data\ActiveDataProvider;

class DefaultController extends BaseFrontendController
{
    public $layout = 'user/main';

    public function publicActions()
    {
        return ['*'];
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