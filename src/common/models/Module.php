<?php

namespace common\models;

use common\components\ModuleClient;
use common\models\base\BaseModule;
use common\models\query\ModuleQuery;
use yii\helpers\FileHelper;
use yii\helpers\Json;

/**
 */
class Module extends BaseModule
{
    const EVENT_INSTALL = 'install';
    const EVENT_UNINSTALL = 'uninstall';

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'moduleId' => '模块 ID',
            'name' => '模块名',
            'description' => '模块描述',
            'github' => 'Github 地址',
            'keywords' => '关键字',
            'version' => '版本号',
            'config' => '模块配置',
            'createdAt' => '创建时间',
            'updatedAt' => '更新时间',
        ];
    }

    /**
     * @inheritdoc
     * @return ModuleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModuleQuery(get_called_class());
    }

    public static function findOneByModuleId($moduleId)
    {
        return static::find()
            ->andWhere(['moduleId' => $moduleId])
            ->one();
    }

    public function install()
    {
        $client = new ModuleClient();
        // 下载
        $zipFile = $client->download($this->moduleId);
        if ($zipFile == false) {
            return false;
        }
        // 解压并安装
        $zip = new \ZipArchive();
        if ($zip->open($zipFile) !== true) {
            return false;
        }
        $zip->extractTo(dirname($zipFile) . '/../installed/');
        $zip->close();
        unlink($zipFile);

        $this->afterInstall();
        return true;
    }

    public function afterInstall()
    {
        $modulePath = \Yii::getAlias(\Yii::$app->params['moduleAutoloadPath'] . '/' . $this->moduleId . '-' . $this->version);
        $config = require $modulePath . '/config.php';
        if (isset($config['config'])) {
            $this->config = Json::encode($config['config']);
        } else {
            $this->config = Json::encode([]);
        }
        $this->save(false);
        $this->trigger(self::EVENT_INSTALL);
    }

    public function getModulePath()
    {
        return \Yii::getAlias(\Yii::$app->params['moduleAutoloadPath'] . '/' . $this->moduleId . '-' . $this->version);;
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        if (!$this->delete()) {
            return false;
        }

        FileHelper::removeDirectory($this->getModulePath());

        $this->afterUninstall();
        return true;
    }

    public function afterUninstall()
    {
        $this->trigger(self::EVENT_UNINSTALL);
    }
}
