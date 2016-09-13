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

class ModuleAutoLoader extends Object implements BootstrapInterface
{
    const CACHE_KEY = 'module-configs';

    public function bootstrap($app)
    {
        $modules = Yii::$app->cache->get(self::CACHE_KEY);
        if ($modules === false) {
            $modules = [];

            $models = Module::find()->all();
            $modulePath = Yii::getAlias(Yii::$app->params['moduleAutoloadPath']);
            foreach ($models as $model) {
                $moduleDir = $modulePath . DIRECTORY_SEPARATOR . $model->moduleId . '-' . $model->version;
                if (is_dir($moduleDir) && is_file($moduleDir . DIRECTORY_SEPARATOR . 'config.php')) {
                    try {
                        $modules[$moduleDir] = require($moduleDir . DIRECTORY_SEPARATOR . 'config.php');
                    } catch (\Exception $ex) {
                    }
                }
            }

            if (!YII_DEBUG) {
                Yii::$app->cache->set(self::CACHE_KEY, $modules);
            }
        }
        foreach ($modules as $basePath => $config) {
            Yii::$app->moduleManager->register($basePath, $config);
        }

    }
}