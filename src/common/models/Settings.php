<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

namespace common\models;

use common\models\base\BaseSettings;
use yii\helpers\Json;

/**
 */
class Settings extends BaseSettings
{
    const WEIBO_APP_KEY = 'weibo-app_key';
    const WEIBO_APP_SECRET = 'weibo-app_secret';

    const SITE_NAME = 'site-name';
    const SITE_URL = 'site-url';
    const SITE_KEYWORDS = 'site-keywords';
    const SITE_DESCRIPTION = 'site-description';

    const TONGJI_CNZZ = "tongji-cnzz";

    const TAOBAO_UNION = 'taobao-union';

    const BEIAN = 'beian';

    const BLOCK_END_BODY = 'block-end_body';

    const BAIDU_PING_SITE = 'baidu-ping_site';
    const BAIDU_PING_TOKEN = 'baidu-ping_token';

    const ALIYUN_ACCESS_KEY_ID = 'aliyun-access_key_id';
    const ALIYUN_ACCESS_KEY_SECRET = 'aliyun-access_key_secret';
    const ALIYUN_ENDPOINT = 'aliyun-endpoint';
    const ALIYUN_BUCKET = 'aliyun-bucket';

    const EMAIL_FROM_NAME = 'email-from_name';
    const EMAIL_FROM_EMAIL = 'email-from_email';
    const EMAIL_SMTP_HOST = 'email-smtp_host';
    const EMAIL_USERNAME = 'email-username';
    const EMAIL_PASSWORD = 'email-password';
    const EMAIL_PORT = 'email-port';
    const EMAIL_ENCRYPTION = 'email-encryption';

    /**
     * @param mixed $value
     * @return string
     */
    public static function encode($value)
    {
        return Json::encode($value);
    }

    /**
     * @param string $value
     * @return mixed
     */
    public static function decode($value)
    {
        return Json::decode($value);
    }

    /**
     * @param string $code
     * @return static
     */
    public static function findOneByCode($code)
    {
        return static::findOne(['code' => $code]);
    }

    /**
     * @param string $code
     * @return null|string
     */
    public static function get($code)
    {
        $model = static::findOneByCode($code);

        if ($model == null) {
            return null;
        }

        return $model->getValue();
    }

    /**
     * @return Settings[]
     */
    public static function getSiteSettings()
    {
        return [
            static::findOneByCode(self::SITE_NAME),
            static::findOneByCode(self::SITE_URL),
            static::findOneByCode(self::SITE_DESCRIPTION),
            static::findOneByCode(self::SITE_KEYWORDS),
        ];
    }

    /**
     * @return string|mixed
     */
    public function getValue()
    {
        return $this->isEncoded ? static::encode($this->value) : $this->value;
    }
}
