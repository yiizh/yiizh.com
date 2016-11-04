<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;

use common\storage\StorageInterface;
use console\components\BaseConsoleController;

class TestController extends BaseConsoleController
{
    public function actionUpload($filename, $content)
    {
        /**
         * @var $storage StorageInterface
         */
        $storage = \Yii::$app->storage;
        $rs = $storage->write($filename, $content);
        echo "Result: {$rs}" . PHP_EOL;
    }

    public function actionRead($filename)
    {
        /**
         * @var $storage StorageInterface
         */
        $storage = \Yii::$app->storage;
        $rs = $storage->read($filename);
        echo "Result: {$rs}" . PHP_EOL;
    }

    public function actionDelete($filename)
    {
        /**
         * @var $storage StorageInterface
         */
        $storage = \Yii::$app->storage;
        $rs = $storage->delete($filename);
        echo "Result: {$rs}" . PHP_EOL;
    }
}