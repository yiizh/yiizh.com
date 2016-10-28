<?php

namespace modules\news\controllers;

use common\models\News;
use common\widgets\Alert;
use frontend\components\BaseFrontendController;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 */
class NewsController extends BaseFrontendController
{
    public function accessRules()
    {
        $rules = parent::accessRules();

        $rules[] = [
            'allow' => true,
            'actions' => ['index', 'headline', 'view'],
        ];

        $rules[] = [
            'allow' => true,
            'actions' => ['suggest'],
            'roles' => ['@']
        ];


        return $rules;
    }

    /**
     * Lists all News models.
     * @param int $type
     * @return mixed
     */
    public function actionIndex($type = null)
    {
        $query = News::find()->andWhere(['status' => News::STATUS_PUBLISHED])->orderBy('createdAt DESC');
        $typeValid = in_array($type, array_keys(News::getTypeItems()));
        if ($typeValid) {
            $query->andByType($type);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'type' => $type,
            'typeValid' => $typeValid
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->status != News::STATUS_PUBLISHED && !Yii::$app->user->can('manageNews')) {
            throw new NotFoundHttpException();
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * 推荐
     *
     * @return mixed
     */
    public function actionSuggest()
    {
        $model = new News([
            'status' => News::STATUS_PROPOSED,
            'scenario' => News::SCENARIO_SUGGEST
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->userId = Yii::$app->user->id;
            if ($model->save(false)) {
                Alert::set('success', '推荐成功');
                return $this->redirect(['index']);
            }
        }

        return $this->render('suggest', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
