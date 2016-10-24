<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\account\controllers;

use common\models\User;
use common\widgets\Alert;
use modules\account\Controller;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        /**
         * @var $model User
         */
        $model = \Yii::$app->user->getIdentity();
        $model->setScenario(User::SCENARIO_PROFILE);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            Alert::set('success', '保存成功。');
            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }
}