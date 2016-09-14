<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\components\bootstrap;


use common\models\Module;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Object;
use yii\log\Logger;

class ModuleAutoLoader extends Object implements BootstrapInterface
{
    public function bootstrap($app)
    {
        try {
            $modules = [];
            $models = Module::find()->all();
            foreach ($models as $model) {
                $modulePath = $model->getModulePath();
                if (is_dir($modulePath) && is_file($modulePath . DIRECTORY_SEPARATOR . 'config.php')) {
                    try {
                        $modules[$modulePath] = require($modulePath . DIRECTORY_SEPARATOR . 'config.php');
                    } catch (\Exception $ex) {
                    }
                }
            }

            foreach ($modules as $basePath => $config) {
                Yii::$app->moduleManager->register($basePath, $config);
            }
        } catch (\Exception $exception) {
            Yii::getLogger()->log($exception->getMessage() . ': ' . $exception->getTraceAsString(), Logger::LEVEL_ERROR);
        }
    }
}