<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers\content;

use common\models\ContentPool;
use common\widgets\Nav;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * ContentController implements the CRUD actions for ContentPool model.
 */
class ContentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function verbs()
    {
        return [
            'delete' => ['POST'],
        ];
    }

    public function init()
    {
        parent::init();
        Nav::setMenu('main-sidebar', [
            ['label' => '内容池', 'url' => ['content/content/index']],
            ['label' => '新增内容', 'url' => ['content/content/create']],
        ]);
    }

    /**
     * Lists all ContentPool models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ContentPool::find(),
            'sort' => [
                'defaultOrder' => ['publishDatetime' => SORT_DESC]
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContentPool model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ContentPool model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContentPool();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ContentPool model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $status = null)
    {
        $model = $this->findModel($id);
        if ($status != null) {
            $model->status = $status;
        }

        if (($model->load(Yii::$app->request->post()) || $status != null) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ContentPool model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContentPool model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentPool the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentPool::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
