<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace frontend\controllers\manage;


use frontend\components\BaseManageController;

class ProjectController extends BaseManageController
{
    public $layout = 'manage/sidebar';

    public function init()
    {
        parent::init();
        $this->getView()->params['sidebar'] = [
            'title' => '项目',
            'items' => [
                ['label' => '所有项目', 'url' => ['/manage/project/index']],
                ['label' => '新增项目', 'url' => ['/manage/project/create']],
            ]
        ];
    }

    public function accessRules()
    {
        $rules = parent::accessRules();

        $rules[] = [
            'allow' => true,
            'roles' => ['manageProject']
        ];

        return $rules;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}