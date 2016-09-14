<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers\manage;

use common\components\ModuleClient;
use common\models\Module;
use frontend\components\BaseFrontendController;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class ModuleController extends BaseFrontendController
{
    public $layout = 'manage/sidebar';

    public function init()
    {
        parent::init();
        $this->getView()->params['sidebar'] = [
            'title' => '模块',
            'items' => [
                [
                    'label' => '已安装',
                    'url' => ['/manage/module/index'],
                ],
                [
                    'label' => '发现',
                    'url' => ['/manage/module/explore'],
                ]
            ]
        ];
    }

    public function accessRules()
    {
        $rules = parent::accessRules();

        $rules[] = [
            'allow' => true,
            'roles' => ['manageModule']
        ];

        return $rules;
    }

    /**
     * 首页
     */
    public function actionIndex()
    {
        $modules = Module::find()->all();

        return $this->render('index', [
            'modules' => $modules
        ]);
    }

    /**
     * 发现
     */
    public function actionExplore()
    {
        $client = new ModuleClient();
        $modules = $client->getModules();
        $installedModules = Module::find()->all();
        $installedModuleIds = ArrayHelper::getColumn($installedModules, 'moduleId');

        return $this->render('explore', [
            'modules' => $modules,
            'installedModuleIds' => $installedModuleIds
        ]);
    }

    public function actionInstall($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $client = new ModuleClient();

        $module = $client->getModule($id);

        $model = new Module();
        $model->moduleId = $module['id'];
        $model->name = $module['name'];
        $model->description = $module['description'];
        $model->github = $module['github'];
        $model->keywords = implode(', ', $module['keywords']);
        $model->version = $module['version'];

        if ($model->save() && $model->install()) {
            return ['success' => true];
        } else {
            return ['success' => false];
        }
    }

    public function actionUninstall($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $module = $this->findModule($id);
        $resp = [
            'success' => true
        ];

        if (!$module->uninstall()) {
            $resp = [
                'success' => false,
            ];
        }

        return $resp;
    }

}