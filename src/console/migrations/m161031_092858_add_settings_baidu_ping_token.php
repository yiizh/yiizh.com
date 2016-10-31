<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use console\components\Migration;

class m161031_092858_add_settings_baidu_ping_token extends Migration
{
    public function up()
    {
        $this->insert('{{%settings}}',
            [
                'name' => '百度主动推送站点',
                'description' => '百度主动推送站点, 如: www.yiizh.com',
                'code' => Settings::BAIDU_PING_SITE,
                'value' => '',
                'isEncoded' => 0,
            ]
        );

        $this->insert('{{%settings}}',
            [
                'name' => '百度主动推送密钥',
                'description' => '百度主动推送密钥',
                'code' => Settings::BAIDU_PING_TOKEN,
                'value' => '',
                'isEncoded' => 0,
            ]
        );
    }

    public function down()
    {
        $this->delete('{{%settings}}', 'code=:code', [':code' => Settings::BAIDU_PING_SITE]);
        $this->delete('{{%settings}}', 'code=:code', [':code' => Settings::BAIDU_PING_TOKEN]);
    }
}
