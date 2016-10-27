<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m161027_075701_create_tbl_ad extends Migration
{
    public $tableName = '{{%ad}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'name' => $this->text()->notNull()->comment('名称'),
            'content' => $this->text()->notNull()->comment('内容'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "广告表"');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
}
