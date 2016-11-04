<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use console\components\Migration;
use yii\helpers\ArrayHelper;

class m161104_064622_add_settings_mail_settings extends Migration
{
    public $tableName = '{{%queue_url}}';

    public $settings = [
        [
            'name' => '邮箱发送名称',
            'description' => '邮箱发送名称 From Name',
            'code' => Settings::EMAIL_FROM_NAME,
            'value' => '',
            'isEncoded' => 0,
        ],
        [
            'name' => '邮箱发送邮箱',
            'description' => '邮箱发送邮箱 From Email',
            'code' => Settings::EMAIL_FROM_EMAIL,
            'value' => '',
            'isEncoded' => 0,
        ],
        [
            'name' => '邮箱 smtp Host',
            'description' => '邮箱 smtp Host',
            'code' => Settings::EMAIL_SMTP_HOST,
            'value' => '',
            'isEncoded' => 0,
        ],
        [
            'name' => '邮箱发送用户',
            'description' => '邮箱发送用户 Username',
            'code' => Settings::EMAIL_USERNAME,
            'value' => '',
            'isEncoded' => 0,
        ],
        [
            'name' => '邮箱发送密码',
            'description' => '邮箱发送密码 Password',
            'code' => Settings::EMAIL_PASSWORD,
            'value' => '',
            'isEncoded' => 0,
        ],
        [
            'name' => '邮箱发送端口',
            'description' => '邮箱发送端口 port',
            'code' => Settings::EMAIL_PORT,
            'value' => '',
            'isEncoded' => 0,
        ],
        [
            'name' => '邮箱发送加密',
            'description' => '邮箱发送加密 Encryption',
            'code' => Settings::EMAIL_ENCRYPTION,
            'value' => '',
            'isEncoded' => 0,
        ],
    ];

    public function up()
    {
        $this->addSettings($this->settings);

    }

    public function down()
    {
        $this->removeSettings(ArrayHelper::getColumn($this->settings, 'code'));
    }
}
