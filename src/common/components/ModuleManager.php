<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\components;


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\console\Application;

class ModuleManager extends Component
{
    protected $modules = [];

    public function register($basePath, $config = null)
    {
        $app = Yii::$app;
        if ($config === null && is_file($basePath . '/config.php')) {
            $config = require($basePath . '/config.php');
        }
        if (!isset($config['class']) || !isset($config['id'])) {
            throw new InvalidConfigException("Module configuration requires an id and class attribute!");
        }
        $this->modules[$config['id']] = $config['class'];
        if (isset($config['namespace'])) {
            Yii::setAlias('@' . str_replace('\\', '/', $config['namespace']), $basePath);
        }
        Yii::setAlias('@' . $config['id'], $basePath);

        if (isset($config['commands']) && $app instanceof Application) {
            foreach ($config['commands'] as $cmd => $class) {
                Yii::$app->controllerMap[$cmd] = $class;
            }
        }

        $moduleConfig = [
            'class' => $config['class'],
        ];
        // Add config file values to module
        if (isset($app->modules[$config['id']]) && is_array($app->modules[$config['id']])) {
            $moduleConfig = \yii\helpers\ArrayHelper::merge($moduleConfig, $app->modules[$config['id']]);
        }
        // Register Yii Module
        $app->setModule($config['id'], $moduleConfig);
    }
}