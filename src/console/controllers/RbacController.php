<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace console\controllers;

use common\models\User;
use console\components\BaseConsoleController;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Console;

class RbacController extends BaseConsoleController
{
    public $defaultAction = 'init';

    public function actionInit()
    {
        if (!$this->confirm("确定？此操作将会重建权限树。")) {
            return self::EXIT_CODE_NORMAL;
        }

        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // 项目管理权限
        $manageProject = $auth->createPermission('manageProject');
        $manageProject->description = '管理项目';
        $auth->add($manageProject);

        // 系统设置管理权限
        $manageSystem = $auth->createPermission('manageSystem');
        $manageSystem->description = '管理系统设置';
        $auth->add($manageSystem);

        // 新闻管理权限
        $manageNews = $auth->createPermission('manageNews');
        $manageNews->description = '管理新闻';
        $auth->add($manageNews);

        // 模块管理权限
        $manageModule = $auth->createPermission('manageModule');
        $manageModule->description = '管理模块';
        $auth->add($manageModule);

        // 角色: 管理员
        $manager = $auth->createRole('manager');
        $manager->description = '管理员';
        $auth->add($manager);

        // 角色: 超级管理员
        $superManager = $auth->createRole('superManager');
        $superManager->description = '超级管理员';
        $auth->add($superManager);
        $auth->addChild($superManager, $manager);

        $auth->addChild($manager, $manageNews);

        $auth->addChild($superManager, $manageNews);
        $auth->addChild($superManager, $manageProject);
        $auth->addChild($superManager, $manageSystem);
        $auth->addChild($superManager, $manageModule);

        $this->stdout('权限树已重置。' . PHP_EOL, Console::FG_GREEN);
    }

    /**
     * 分配角色
     *
     * @param $role
     * @param $email
     */
    public function actionAssign($role, $email)
    {
        $user = User::findOneByEmail($email);
        if (!$user) {
            throw new InvalidParamException("没有找到邮箱为 \"{$email}\" 的用户。");
        }
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role);
        if (!$role) {
            throw new InvalidParamException("没有找到角色 \"{$email}\"。");
        }

        $assignment = $auth->getAssignment($role->name, $user->id);

        if (!$assignment) {
            $auth->assign($role, $user->id);
        }

        $this->stdout('已分配。' . PHP_EOL, Console::FG_GREEN);
    }
}