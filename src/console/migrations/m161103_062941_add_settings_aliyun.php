<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use console\components\Migration;
use yii\helpers\ArrayHelper;

class m161103_062941_add_settings_aliyun extends Migration
{
    public $tableName = '{{%queue_url}}';

    public $settings = [
        [
            'name' => '阿里云 Access Key Id',
            'description' => '阿里云 Access Key Id',
            'code' => Settings::ALIYUN_ACCESS_KEY_ID,
            'value' => '',
            'isEncoded' => 0,
        ],
        [
            'name' => '阿里云 Access Key Secret',
            'description' => '阿里云 Access Key Secret',
            'code' => Settings::ALIYUN_ACCESS_KEY_SECRET,
            'value' => '',
            'isEncoded' => 0,
        ],
        [
            'name' => '阿里云 Endpoint',
            'description' => '阿里云 Endpoint',
            'code' => Settings::ALIYUN_ENDPOINT,
            'value' => '',
            'isEncoded' => 0,
        ],
        [
            'name' => '阿里云 Bucket',
            'description' => '阿里云 Bucket',
            'code' => Settings::ALIYUN_BUCKET,
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
