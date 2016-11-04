<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161104_085319_create_tbl_session extends Migration
{
    public $tableName = '{{%session}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->string()->notNull(),
            'expire' => $this->integer(),
            'data' => $this->text(),
            'PRIMARY KEY ([[id]])',
        ], $this->tableOptions . ' comment "Session 表"');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

}
