<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use console\components\Migration;

class m161025_063543_add_settings_baidu_cnzz extends Migration
{
    public function up()
    {
        $this->insert('{{%settings}}',
            [
                'name' => 'CNZZ 统计',
                'description' => 'CNZZ 统计代码',
                'code' => Settings::TONGJI_CNZZ,
                'value' => '',
                'isEncoded' => 0,
            ]
        );
    }

    public function down()
    {
        $this->delete('{{%settings}}', 'code=:code', [':code' => Settings::TONGJI_CNZZ]);
    }

}
