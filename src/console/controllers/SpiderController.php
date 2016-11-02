<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;


use common\clients\baidu\Baidu;
use common\models\QueueUrl;
use console\components\BaseConsoleController;
use yii\helpers\ArrayHelper;

class SpiderController extends BaseConsoleController
{
    public $defaultAction = 'push';

    public function actionPush($limit = 100)
    {
        $query = QueueUrl::find()
            ->pending()
            ->limit($limit);
        $urlCount = $query->count();
        if ($urlCount == 0) {
            echo "No url to push." . PHP_EOL;
            return self::EXIT_CODE_NORMAL;
        }

        $models = $query->all();
        $urls = [];
        foreach ($models as $model) {
            $urls[$model->id] = $model->url;
        }

        /**
         * @var $baidu Baidu
         */
        $baidu = \Yii::$app->baidu;
        $rs = $baidu->ping($urls);

        if ($rs['success']) {
            // 推送成功
            QueueUrl::updateAll([
                'status' => QueueUrl::STATUS_PUSHED
            ], ['in', 'id', ArrayHelper::getColumn($models, 'id')]);
            echo "推送 {$urlCount} url 到搜索引擎成功." . PHP_EOL;
            echo "当天剩余 {$rs['remain']} 可推送 url 条数 " . PHP_EOL;
        } else {
            // 推送失败
            echo "推送 {$urlCount} url 到搜索引擎失败." . PHP_EOL;
            echo "错误代码: {$rs['errorCode']}" . PHP_EOL;
            echo "错误信息: {$rs['errorMessage']}" . PHP_EOL;
        }

    }
}