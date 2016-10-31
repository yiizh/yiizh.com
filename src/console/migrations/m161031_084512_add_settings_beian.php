<?php
use common\models\Settings;
use console\components\Migration;

/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

class m161031_084512_add_settings_beian extends Migration
{
    public function up()
    {
        $this->insert('{{%settings}}',
            [
                'name' => '备案号',
                'description' => '备案号',
                'code' => Settings::BEIAN,
                'value' => '',
                'isEncoded' => 0,
            ]
        );
    }

    public function down()
    {
        $this->delete('{{%settings}}', 'code=:code', [':code' => Settings::BEIAN]);
    }
}