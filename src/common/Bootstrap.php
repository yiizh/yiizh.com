<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common;

use common\models\Settings;
use common\storage\LocalStorage;
use libs\aliyun\AliyunStorage;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        // 根据环境设置使用不同的存储
        switch (getenv('APP_ENV')) {
            case 'dev':
                $app->set('storage', [
                    'class' => LocalStorage::className(),
                    'path' => '@frontend/web/uploads',
                ]);
                break;
            case 'prod':
                $app->set('storage', [
                    'class' => AliyunStorage::className(),
                    'accessKeyId' => Settings::get(Settings::ALIYUN_ACCESS_KEY_ID),
                    'accessKeySecret' => Settings::get(Settings::ALIYUN_ACCESS_KEY_SECRET),
                    'endpoint' => Settings::get(Settings::ALIYUN_ENDPOINT),
                    'bucket' => Settings::get(Settings::ALIYUN_BUCKET),
                ]);
                break;
        }

    }

}