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

class OpenidController extends Controller
{
    public function verbs()
    {
        return [
            'unbind' => ['post']
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $user = \Yii::$app->user->getIdentity();

        return $this->render('index', [
            'user' => $user
        ]);
    }

    /**
     * 取消绑定
     *
     * @return \yii\web\Response
     */
    public function actionUnbind()
    {
        /* @var $user User */
        $user = \Yii::$app->user->getIdentity();
        if ($user->unbind('weibo')) {
            Alert::set('success', '解除绑定成功。');
            return $this->redirect(['index']);
        }
    }
}