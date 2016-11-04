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

        // 基础管理权限
        $manage = $auth->createPermission('manage');
        $manage->description = '基础管理权限';
        $auth->add($manage);

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

        // 广告管理权限
        $manageAd = $auth->createPermission('manageAd');
        $manageAd->description = '管理广告';
        $auth->add($manageAd);

        // 文章管理权限
        $managePost = $auth->createPermission('managePost');
        $managePost->description = '管理文章';
        $auth->add($managePost);

        // 队列管理权限
        $manageQueue = $auth->createPermission('manageQueue');
        $manageQueue->description = '管理队列';
        $auth->add($manageQueue);

        // 文件管理权限
        $manageFile = $auth->createPermission('manageFile');
        $manageFile->description = '管理文件';
        $auth->add($manageFile);

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

        $auth->addChild($manager, $manage);

        $auth->addChild($superManager, $manage);
        $auth->addChild($superManager, $manageNews);
        $auth->addChild($superManager, $manageProject);
        $auth->addChild($superManager, $manageSystem);
        $auth->addChild($superManager, $manageAd);
        $auth->addChild($superManager, $managePost);
        $auth->addChild($superManager, $manageQueue);
        $auth->addChild($superManager, $manageFile);

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