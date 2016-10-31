<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\post\controllers;

use common\models\Post;
use modules\post\Controller;
use yii\data\ActiveDataProvider;

class PostController extends Controller
{
    public function accessRules()
    {
        $rules = parent::accessRules();
        $rules[] = [
            'allow' => true,
            'actions' => ['index', 'view']
        ];
        return $rules;
    }

    public function actionIndex()
    {
        $query = Post::find()->active()->published()->orderBy('publishDatetime DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findPost($id);
        $model->updateCounters(['viewCount' => 1]);

        return $this->render('view', [
            'model' => $model
        ]);
    }
}