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
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\swiftmailer\Mailer;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        $this->asCommon($app);

        // 根据环境设置使用不同的存储
        switch (getenv('APP_ENV')) {
            case 'dev':
                $this->asDev($app);
                break;
            case 'prod':
                $this->asProd($app);
                break;
        }
    }

    /**
     * @param Application $app
     */
    public function asCommon($app)
    {
        $app->set('mailer', [
            'class' => Mailer::className(),
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => Settings::get(Settings::EMAIL_SMTP_HOST),
                'username' => Settings::get(Settings::EMAIL_USERNAME),
                'password' => Settings::get(Settings::EMAIL_PASSWORD),
                'port' => Settings::get(Settings::EMAIL_PORT),
                'encryption' => Settings::get(Settings::EMAIL_ENCRYPTION),
            ],
        ]);
    }

    /**
     * @param Application $app
     */
    public function asDev($app)
    {
        $app->set('storage', [
            'class' => LocalStorage::className(),
            'path' => '@frontend/web/uploads',
        ]);
    }

    /**
     * @param Application $app
     */
    public function asProd($app)
    {
        $app->set('storage', [
            'class' => AliyunStorage::className(),
            'accessKeyId' => Settings::get(Settings::ALIYUN_ACCESS_KEY_ID),
            'accessKeySecret' => Settings::get(Settings::ALIYUN_ACCESS_KEY_SECRET),
            'endpoint' => Settings::get(Settings::ALIYUN_ENDPOINT),
            'bucket' => Settings::get(Settings::ALIYUN_BUCKET),
        ]);

    }

}