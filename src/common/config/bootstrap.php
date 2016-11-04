<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

defined('APP_ROOT') or define('APP_ROOT', dirname(dirname(dirname(__DIR__))));
defined('APP_SRC_ROOT') or define('APP_SRC_ROOT', APP_ROOT . '/src');
defined('APP_API') or define('APP_API', 'app-api');
defined('APP_CONSOLE') or define('APP_CONSOLE', 'app-console');
defined('APP_FRONTEND') or define('APP_FRONTEND', 'app-frontend');

Yii::setAlias('@root', APP_ROOT);
Yii::setAlias('@common', APP_SRC_ROOT . '/common');
Yii::setAlias('@modules', APP_SRC_ROOT . '/modules');
Yii::setAlias('@api', APP_SRC_ROOT . '/api');
Yii::setAlias('@console', APP_SRC_ROOT . '/console');
Yii::setAlias('@frontend', APP_SRC_ROOT . '/frontend');
Yii::setAlias('@libs', APP_SRC_ROOT . '/libs');

if (file_exists(APP_ROOT . '/env.ini')) {
    $env = new Dotenv\Dotenv(APP_ROOT, 'env.ini');
    $env->load();
}