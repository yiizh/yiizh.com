<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers;

use common\models\File;
use common\storage\UploadedFile;
use frontend\components\BaseFrontendController;
use Yii;
use yii\web\Response;

class UploadController extends BaseFrontendController
{
    public function accessRules()
    {
        $rules = parent::accessRules();

        $rules[] = [
            'allow' => true,
            'roles' => ['@']
        ];

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function trustActions()
    {
        return ['fullavatareditor'];
    }

    public function actionFullavatareditor()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $file = UploadedFile::getInstanceByName('__avatar1');

        if ($file && !$file->hasError) {
            $dir = date('Y/m/d');
            $fileName = $dir . '/' . md5(Yii::$app->security->generateRandomString()) . '.jpg';

            if ($file->saveAs($fileName)) {
                $model = new File();
                $model->name = pathinfo($fileName, PATHINFO_FILENAME);
                $model->mimeType = 'image/jpg';
                $model->extension = 'jpg';
                $model->path = $fileName;
                $model->uploaderId = Yii::$app->user->id;
                $model->size = $file->size;

                if (!$model->save()) {
                    return [
                        'success' => false,
                        'msg' => '保存文件失败'
                    ];
                }

                return [
                    "success" => true,
                    "sourceUrl" => $model->getUrl(),
                    "avatarUrls" => [$model->getUrl()]
                ];
            } else {
                return [
                    'success' => false,
                    'msg' => '保存文件失败'
                ];
            }
        } else {
            return [
                'success' => false,
                'msg' => '上传失败'
            ];
        }
    }
}