<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;

use common\auth\AuthHandler;
use frontend\components\BaseFrontendController;
use frontend\forms\LoginForm;
use frontend\forms\PasswordResetRequestForm;
use frontend\forms\RegisterForm;
use frontend\forms\ResetPasswordForm;
use Yii;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class SiteController extends BaseFrontendController
{
    public function publicActions()
    {
        return [
            '*'
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'auth' => [
                'class' => AuthAction::className(),
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @param ClientInterface $client
     */
    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }

    public function actionIndex()
    {
        return $this->redirect(['/news/index']);
    }

    /**
     * 登录
     * @param string|null $authclient
     * @return string|\yii\web\Response
     */
    public function actionLogin($authclient = null)
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if ($authclient != null) {
                return $this->redirect(['/site/auth', 'authclient' => $authclient]);
            }
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 注册
     * @param string|null $authclient
     * @return string|\yii\web\Response
     */
    public function actionRegister($authclient = null)
    {
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->register()) {
                if (Yii::$app->getUser()->login($user, 3600 * 24 * 30)) {
                    if ($authclient != null) {
                        return $this->redirect(['/site/auth', 'authclient' => $authclient]);
                    }
                    return $this->goHome();
                }
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * 退出登录
     *
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * 忘记密码
     *
     * @return string|\yii\web\Response
     */
    public function actionForget()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', '操作成功，重置密码邮件已发送到邮箱。');
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('error', '发送重置密码邮件失败。');
            }
        }
        return $this->render('forget', [
            'model' => $model,
        ]);
    }

    /**
     * 重置密码
     *
     * @param string $token
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', '重置密码成功。');
            return $this->goHome();
        }
        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }
}
