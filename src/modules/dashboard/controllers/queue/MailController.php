<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers\queue;

use common\models\MailContent;
use common\models\QueueMail;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

/**
 * MailController implements the CRUD actions for QueueMail model.
 */
class MailController extends Controller
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

    /**
     * Lists all QueueMail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => QueueMail::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QueueMail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $mailContent = $model->mailContent;

        return $this->render('view', [
            'model' => $model,
            'mailContent' => $mailContent
        ]);
    }

    /**
     * Creates a new QueueMail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QueueMail();
        $mailContent = new MailContent();

        if ($model->load(Yii::$app->request->post()) && $mailContent->load(Yii::$app->request->post()) && $model->newMail($mailContent)) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            echo Html::errorSummary($model);
            return $this->render('create', [
                'model' => $model,
                'mailContent' => $mailContent
            ]);
        }
    }

    /**
     * Deletes an existing QueueMail model.
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
     * Finds the QueueMail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QueueMail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QueueMail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
