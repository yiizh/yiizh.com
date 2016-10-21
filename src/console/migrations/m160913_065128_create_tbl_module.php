<?php

use console\components\Migration;

class m160913_065128_create_tbl_module extends Migration
{
    public $tableName = '{{%module}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'moduleId' => $this->string(200)->notNull()->comment('模块 ID'),
            'name' => $this->string(200)->notNull()->comment('模块名'),
            'description' => $this->string(500)->notNull()->comment('模块描述'),
            'github' => $this->string(500)->notNull()->comment('Github 地址'),
            'keywords' => $this->string(200)->comment('关键字'),
            'version' => $this->string(50)->comment('版本号'),
            'config' => $this->text()->comment('模块配置'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "演示模块表"');
        $this->createIndex('idx-module_moduleId', $this->tableName, 'moduleId', true);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
