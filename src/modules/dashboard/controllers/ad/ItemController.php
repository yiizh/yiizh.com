<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace modules\dashboard\controllers\ad;

use common\models\AdPositionItem;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * ItemController implements the CRUD actions for AdPositionItem model.
 */
class ItemController extends Controller
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
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdPositionItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['ad/position/view', 'id' => $model->positionId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdPositionItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $positionId
     * @param integer $adId
     * @return mixed
     */
    public function actionUpdate($positionId, $adId)
    {
        $model = $this->findModel($positionId, $adId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'positionId' => $model->positionId, 'adId' => $model->adId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AdPositionItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $positionId
     * @param integer $adId
     * @return mixed
     */
    public function actionDelete($positionId, $adId)
    {
        $model = $this->findModel($positionId, $adId);
        $model->delete();

        return $this->redirect(['ad/position/view', 'id' => $model->positionId]);
    }

    /**
     * Finds the AdPositionItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $positionId
     * @param integer $adId
     * @return AdPositionItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($positionId, $adId)
    {
        if (($model = AdPositionItem::findOne(['positionId' => $positionId, 'adId' => $adId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
