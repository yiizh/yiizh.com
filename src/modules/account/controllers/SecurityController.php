<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\account\controllers;


use common\models\User;
use common\widgets\Alert;
use frontend\forms\ChangePasswordForm;
use modules\account\Controller;

class SecurityController extends Controller
{
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