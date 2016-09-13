<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;


use common\components\ModuleClient;
use console\components\BaseConsoleController;

class TestController extends BaseConsoleController
{
    public function actionIndex(){
        $client = new ModuleClient();
        $modules = $client->getModules();
        print_r($modules);
    }
}