<?php

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
