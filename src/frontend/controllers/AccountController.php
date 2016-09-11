<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;


use common\models\User;
use common\widgets\Alert;
use frontend\components\BaseFrontendController;
use frontend\forms\ChangePasswordForm;

class AccountController extends BaseFrontendController
{
    public $layout = 'account';

    public function accessRules()
    {
        $rules = parent::accessRules();

        $rules[] = [
            'allow' => true,
            'roles' => ['@']
        ];

        return $rules;
    }

    /**
     * 个人资料
     *
     * @return string
     */
    public function actionProfile()
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

        return $this->render('profile', [
            'model' => $model
        ]);
    }

    /**
     * 修改密码
     *
     * @return string|\yii\web\Response
     */
    public function actionChangePassword()
    {
        /**
         * @var $user User
         */
        $user = \Yii::$app->user->getIdentity();
        $user->setScenario(User::SCENARIO_CHANGE_PASSWORD);

        $model = new ChangePasswordForm($user);

        if ($model->load(\Yii::$app->request->post()) && $model->changePassword()) {
            Alert::set('success', '密码已修改，下次登录请使用新密码。');
            return $this->refresh();
        }

        return $this->render('change-password', [
            'model' => $model
        ]);
    }
}