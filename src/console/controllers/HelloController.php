<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;

use console\components\BaseConsoleController;
use yii\helpers\Console;

class HelloController extends BaseConsoleController
{
    public function actionIndex()
    {
        $user = Console::input("Who you are? ");
        echo "Hello {$user}!" . PHP_EOL;
    }
}