<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers\user;


use frontend\components\BaseFrontendController;

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

        return $this->render('index', [
            'model' => $model
        ]);
    }
}