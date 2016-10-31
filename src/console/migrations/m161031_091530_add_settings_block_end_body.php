<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use console\components\Migration;

class m161031_091530_add_settings_block_end_body extends Migration
{
    public function up()
    {
        $this->insert('{{%settings}}',
            [
                'name' => 'END BODY 代码块',
                'description' => 'END BODY 代码块',
                'code' => Settings::BLOCK_END_BODY,
                'value' => '',
                'isEncoded' => 0,
            ]
        );
    }

    public function down()
    {
        $this->delete('{{%settings}}', 'code=:code', [':code' => Settings::BLOCK_END_BODY]);
    }
}
