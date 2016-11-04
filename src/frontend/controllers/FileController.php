<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;


use common\helper\FileHelper;
use common\models\File;
use frontend\components\BaseFrontendController;
use yii\web\NotFoundHttpException;

class FileController extends BaseFrontendController
{
    public function publicActions()
    {
        return ['view'];
    }

    public function actionView($id, $name = '', $extension = '')
    {
        $model = $this->findModel($id);
        return \Yii::$app->response
            ->sendContentAsFile($model->getContent(), $model->getFilename(), [
                'mimeType' => $model->mimeType,
                'inline' => FileHelper::getIsInlineByExtension($model->extension) || FileHelper::getIsInlineByMimeType($model->mimeType)
            ]);
    }

    /**
     * @param integer $id
     * @return File
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('文件不存在.');
        }
    }
}