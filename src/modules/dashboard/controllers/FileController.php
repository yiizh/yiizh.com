<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers;

use common\models\File;
use common\widgets\Alert;
use common\widgets\Nav;
use modules\dashboard\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends Controller
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

    public function accessRules()
    {
        return [
            ['allow' => true, 'roles' => ['manageFile']]
        ];
    }

    public function init()
    {
        parent::init();
        Nav::setMenu('main-sidebar', [
            [
                'label' => '上传文件',
                'url' => ['create'],
            ],
            ['label' => '所有文件',
                'url' => ['index'],
            ],
        ]);
    }

    /**
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => File::find(),
            'sort' => [
                'defaultOrder' => [
                    'createdAt' => SORT_DESC
                ]
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single File model.
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
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new File();
        $model->setScenario(File::SCENARIO_UPLOAD);
        $model->uploaderId = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->upload()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUploadWidget()
    {
        $this->layout = 'blank';
        $model = new File();
        $model->setScenario(File::SCENARIO_UPLOAD);
        $model->uploaderId = Yii::$app->user->id;

        $file = null;

        if ($model->load(Yii::$app->request->post()) && $model->upload()) {
            Alert::set('success','上传成功!');
            $file = clone $model;
            $model = new File();

        }
        return $this->render('upload-widget', [
            'model' => $model,
            'file'=>$file
        ]);
    }

    /**
     * Updates an existing File model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing File model.
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
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
