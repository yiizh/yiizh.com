<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161118_064241_create_tbl_tag extends Migration
{
    public $tableName = '{{%tag}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('标签'),
        ],$this->tableOptions.' comment "标签表"');

        $this->createIndex('idx-tag-name', $this->tableName, 'name', true);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

}
