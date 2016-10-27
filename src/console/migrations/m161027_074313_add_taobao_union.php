<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use common\models\Settings;
use console\components\Migration;

class m161027_074313_add_taobao_union extends Migration
{
    public function up()
    {
        $this->insert('{{%settings}}',
            [
                'name' => '淘宝推广单元',
                'description' => '淘宝推广单元',
                'code' => Settings::TAOBAO_UNION,
                'value' => '',
                'isEncoded' => 0,
            ]
        );
    }

    public function down()
    {
        $this->delete('{{%settings}}', 'code=:code', [':code' => Settings::TAOBAO_UNION]);
    }
}
